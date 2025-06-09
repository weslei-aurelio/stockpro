<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class PdvController extends Controller
{
    public function index () 
    {
        return view ('pdv.index');
    }

    public function storeSale (Request $request) 
    {
        $data = $request->all();

        // Converte os campos da request
        $data['items'] = array_map(function ($item) {
            return [
                'id'            => (int)   $item['id'],
                'quantity'      => (int)   $item['quantity'],
                'salePrice'     => (float) $item['salePrice'],
                'totalItem'     => (float) $item['totalItem'],
                'description'   => $item['description'],
            ];
        }, $data['items']);

        $request->merge($data);
        $validated = $request->validate([
            'total'        => 'required|numeric',
            'items'             => 'required|array|min:1',
            'items.*.id'        => 'required|integer|exists:products,id',
            'items.*.quantity'  => 'required|integer|min:1',
            'items.*.salePrice' => 'required|numeric',
            'items.*.totalItem' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'sale_date'     => now(),
                'sale_value'    => $request->total,
            ]);

            foreach ($request->items as $item) {
                SaleItem::create([
                    'sale_id'       => $sale->id,
                    'product_id'    => $item['id'],
                    'quantity'      => $item['quantity'],
                    'unit_value'    => $item['salePrice'],
                    'item_total'    => $item['totalItem'],
                ]);

                // (opcional: atualizar estoque aqui)
            }

            DB::commit();
            return response()->json(['message' => 'Venda salva com sucesso.']);

        } catch (\Exception $e) {
            DB::rollBack();
             return response()->json([
                'message' => 'Erro ao salvar venda.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
