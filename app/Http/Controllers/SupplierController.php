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
    $keyword = $request->keyword;

    $suppliers = Supplier::with('status')
        ->orderBy('status_id')
        ->orderBy('name')
        ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->simplePaginate(10);

    return view('suppliers.index', compact('suppliers', 'keyword'));
}


    public function crate() 
    {
        return view('suppliers.create');
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
    ], [
        'name.required'  => 'O campo nome é obrigatório.',
        'email.required' => 'O campo e-mail é obrigatório.',
        'phone.required' => 'O campo telefone é obrigatório.',
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator, 'edit')
            ->withInput();
    }

    $supplier = Supplier::findOrFail($id);
    $supplier->update($request->only('name', 'email', 'phone', 'observation'));

    return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
}


     public function store(Request $request) 
{
    $data = $request->validate([
        'name'        => 'required|string',
        'email'       => 'required|string|email',
        'phone'       => 'required|string',
        'observation' => 'nullable|string',
    ]);

    $data['status_id'] = 1;

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
