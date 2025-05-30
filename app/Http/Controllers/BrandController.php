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

        return redirect()
            ->route('brands.index')
            ->with('status', 'Marca cadastrada com sucesso!');

    }

    public function inactivate() 
    {

    }

    public function activate() 
    {

    }
}
