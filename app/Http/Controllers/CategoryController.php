<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Status;

class CategoryController extends Controller
{
    public function index() 
{
    $search = request('search');

    if ($search) {
        $categories = Category::where('name', 'like', '%'.$search.'%')->get();
    } else {
        $categories = Category::all();
    }

    return view('categories.index', compact('categories', 'search'));
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

  public function inactivate(Category $category)
{
    $category->status_id = Status::SUSPENSO;
    $category->save();

    request()->session()->flash('success', 'Categoria inativada com sucesso!');
    return redirect()->route('categories.index');
}

public function activate(Category $category)
{
    $category->status_id = Status::ATIVO;
    $category->save();

    request()->session()->flash('success', 'Categoria ativada com sucesso!');
    return redirect()->route('categories.index');
}

}
