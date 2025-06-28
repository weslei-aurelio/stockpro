<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::query()
            ->orderBy('status_id')
            ->orderBy('name')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->simplePaginate(10);
        return view('categories.index', compact('categories'));
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

    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Categoria editada com sucesso!');
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
