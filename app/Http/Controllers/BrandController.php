<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Brand;

class BrandController extends Controller
{
    public function index () 
    {
        $brands = Brand::all();

        return view('brands.index', compact('brands'));
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

public function activate(Category $brand)
{
    $brand->status_id = Status::ATIVO;
    $brand->save();

    request()->session()->flash('success', 'Marca ativada com sucesso!');
    return redirect()->route('brands.index');
}
}
