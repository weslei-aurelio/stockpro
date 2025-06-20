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

        request()->session()->flash('success', 'Fornecedor cadastrado com sucesso');
        return redirect()->route('suppliers.index');
    }
}
