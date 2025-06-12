<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request) 
    {   
        $input = $request->validate([
            'name' => 'required|string'
        ]);

        Category::create($input);

        request()->session()->flash('success', 'Categoria Cadastrada com Sucesso');

        return redirect()->route('categories.index');

        // return redirect()
        //     ->route('categories.index')
        //     ->with('status', 'Categoria cadastrada com sucesso!');
    }
}
