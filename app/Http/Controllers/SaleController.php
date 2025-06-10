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
}
