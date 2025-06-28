<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Brand;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::query()
            ->orderBy('status_id')
            ->orderBy('name')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->simplePaginate(10);

        return view('brands.index', compact('brands'));
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator, 'edit')
            ->withInput();
    }

    $brand = Brand::findOrFail($id);
    $brand->name = $request->name;
    $brand->save();

    return redirect()->route('brands.index')->with('success', 'Marca editada com sucesso!');
}

    public function create ()
    {   
        return view('brands.create');
    }

    public function store (Request $request) 
    {
        $input = $request->validate([
            'name' => 'required|string'
        ]);

        Brand::create($input);

        request()->session()->flash('success', 'Marca Cadastrada com Sucesso');

        return redirect()->route('brands.index');

        // return redirect()
        //     ->route('brands.index')
        //     ->with('status', 'Marca cadastrada com sucesso!');

    }

    public function inactivate(Brand $brand)
{
    $brand->status_id = Status::SUSPENSO;
    $brand->save();

    request()->session()->flash('success', 'Marca inativada com sucesso!');
    return redirect()->route('brands.index');
}

public function activate(Brand $brand)
{
    $brand->status_id = Status::ATIVO;
    $brand->save();

    request()->session()->flash('success', 'Marca ativada com sucesso!');
    return redirect()->route('brands.index');
}
}
