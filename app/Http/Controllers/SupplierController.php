<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
   public function index(Request $request)
    {
        $suppliers = Supplier::query()
            ->orderBy('status_id')
            ->orderBy('name')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->simplePaginate(10);
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

    public function inactivate(Supplier $suppliers)
{
    $suppliers->status_id = Status::SUSPENSO;
    $suppliers->save();

    request()->session()->flash('success', 'Fornecedor inativado com sucesso!');
    return redirect()->route('suppliers.index');
}

public function activate(Supplier $suppliers)
{
    $suppliers->status_id = Status::ATIVO;
    $suppliers->save();

    request()->session()->flash('success', 'Fornecedor ativado com sucesso!');
    return redirect()->route('suppliers.index');
}

}
