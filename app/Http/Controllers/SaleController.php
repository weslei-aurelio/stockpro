<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;

class SaleController extends Controller
{
    public function movementReport (Request $request)
    {
        $itens = SaleItem::with(['product', 'sale'])
                    ->orderBy('sale_id')
                    ->get();

        $totalLucro = $itens->sum(function ($item) {
            $lucroPorUnidade = $item->unit_value - $item->product->purchaseValue;
            return $lucroPorUnidade * $item->quantity;
        });

        return view('sales.reports.movements.index', compact('itens', 'totalLucro'));
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
        ->get();

       return view('sales.reports.best_selling_products.index', compact('products')); 
    }
}
