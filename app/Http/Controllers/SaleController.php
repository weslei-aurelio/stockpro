<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function movementReport (Request $request)
    {
        $filterPeriodo = $request->input('periodo') ?? null;
        $inicio = null;
        $fim    = null;

        $request->session()->forget('error');

        if (!empty($filterPeriodo)) {
            $periodo = explode(' até ', $filterPeriodo);
            try {
                $de = Carbon::createFromFormat('d/m/Y', $periodo[0])->format('Y-m-d');
                $ate = Carbon::createFromFormat('d/m/Y', isset($periodo[1]) ? $periodo[1] : $periodo[0])->format('Y-m-d');
            } catch (\Exception $e) {
                abort(404);
            }

            $inicio = isset($de) ? $de : $inicio;
            $fim = isset($ate) ? $ate : $fim;
        }

        $inicio = isset($inicio) ? $inicio : Carbon::yesterday()->format('Y-m-d');
        $fim = isset($fim) ? $fim : Carbon::now()->format('Y-m-d');

        $request->merge([
            'inicio' => $inicio,
            'fim'    => $fim
        ]);

        $diferencaEntreDatas = datetimeDifference($request->fim, $request->inicio);
        
        if ($diferencaEntreDatas > 90) {
            $itens = collect();
            $totalLucro = 0;

            request()->session()->flash('error', 'Período máximo permitido: 90 dias');
            return view('sales.reports.movements.index', compact('itens', 'totalLucro', 'inicio', 'fim'));
        }

        $itens = $this->getItensSalePeriod($request, $inicio, $fim);
        $totalLucro = $this->calculateProfitItemsSale($inicio, $fim);

        return view('sales.reports.movements.index', compact('itens', 'totalLucro', 'inicio', 'fim'));
    }

    public function bestSellingProducts() 
    {
        $products = SaleItem::selectRaw('
            product_id,
            SUM(quantity) as total_vendido,
            SUM((salePrice - products.purchaseValue) * quantity) as lucro_total
        ')
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->groupBy('product_id', 'products.description', 'products.profitMargin')
            ->addSelect('products.description', 'products.profitMargin')
            ->orderByDesc('total_vendido')
            ->simplePaginate(10);

       return view('sales.reports.best_selling_products.index', compact('products')); 
    }

    private function getItensSalePeriod($request, $inicio, $fim) 
    {
        return SaleItem::with(['product', 'sale'])
                ->where('created_at', '>=', $inicio.' 00:00:00')
                ->where('created_at', '<=', $fim.' 23:59:59')
                ->orderBy('created_at', 'asc')
                ->simplePaginate(10)
                ->appends($request->query());
    }

    private function calculateProfitItemsSale($inicio, $fim) 
    {
        $totalLucro = SaleItem::with('product')
            ->where('created_at', '>=', $inicio.' 00:00:00')
            ->where('created_at', '<=', $fim.' 23:59:59')
            ->get()
            ->sum(function ($item) {
                $lucroPorUnidade = $item->unit_value - $item->product->purchaseValue;
                return $lucroPorUnidade * $item->quantity;
            });

        return $totalLucro;
    }

}
