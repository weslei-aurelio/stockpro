<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Brand;

class BrandController extends Controller
{
    public function index () 
    {
        return view('brands.index');
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
}
