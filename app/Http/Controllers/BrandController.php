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
    $keyword = $request->keyword;

    $brands = Brand::query()
        ->orderBy('status_id')
        ->orderBy('name')
        ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->simplePaginate(10);

    return view('brands.index', compact('brands', 'keyword'));
}


    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
    'name' => 'required|string|max:255',
], [
    'name.required' => 'O campo marca é obrigatório.',
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

    public function store(Request $request)
    {
        $brand = new Brand();

       $validator = Validator::make($request->all(), [
        'name' => 'required|string',
    ], [
        'name.required' => 'O campo marca é obrigatório.',
    ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'create')
                ->withInput();
        }

        $brand->name      = $request->name;
        $brand->status_id = Status::ATIVO;
        $brand->save();

        request()->session()->flash('success', 'Marca Cadastrada com sucesso');
        return redirect()->route('brands.index');
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
