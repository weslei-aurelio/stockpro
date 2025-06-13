<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index() 
    {
        $suppliers = Supplier::all();

        return view('suppliers.index', compact('suppliers'));
    }

    public function crate() 
    {
        return view('suppliers.create');
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            'name'        => 'required|string',
            'email'       => 'required|string|email',
            'phone'       => 'required|string',
            'observation' => 'nullable|string'
        ]);

        Supplier::create($data);

        return redirect()
            ->route('suppliers.index');
    }

    public function edit(Supplier $supplier)
    {
        return view ('suppliers.edit', compact('supplier'));
    }

    public function update(Supplier $supplier, Request $request) 
    {
        $data = $request->validate([
            'name'        => 'string|required',
            'email'       => 'email|required',
            'phone'       => 'string|required',
            'observation' => 'string',
        ]);

        $supplier->fill($data);
        $supplier->save();

        return redirect()
            ->route('suppliers.index')
            ->with('status', 'Fornecedor atualizado com sucesso!');
    }
}
