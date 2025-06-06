<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Brand;
use \App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
    public function index ()
    {
        $brands = Brand::all();
        $categories = Category::all();
        
        return view('product.index', compact('brands', 'categories'));
    }

    public function create () 
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('product.create', compact('brands', 'categories'));
    }

    public function store (Request $request)
    {
        dd($request);

        $input = $request->validate([
            'description'   => 'required|string',
            'brand_id'      => ['required', 'exists:brands, id'],
            'category_id'   => ['required', 'exists:categories, id'],
            'purchaseValue' => 'required|string',
            'salePrice'     => 'required|string',
            'profitMargin'  => 'required|string',
            'numberUnits'   => 'required|integer'
        ]);

        
        Product::save($input);
    }
}
