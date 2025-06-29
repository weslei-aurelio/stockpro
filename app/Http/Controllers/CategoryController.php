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

            $keyword = $request->keyword; 
            
        return view('categories.index', compact('categories', 'keyword'));
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
    'name' => 'required|string|max:255',
], [
    'name.required' => 'O campo categoria é obrigatório.',
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
        $category = new Category();

       $validator = Validator::make($request->all(), [
        'name' => 'required|string',
    ], [
        'name.required' => 'O campo categoria é obrigatório.',
    ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'create')
                ->withInput();
        }

        $category->name      = $request->name;
        $category->status_id = Status::ATIVO;
        $category->save();

        request()->session()->flash('success', 'Categoria Cadastrada com sucesso');
        return redirect()->route('categories.index');
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
