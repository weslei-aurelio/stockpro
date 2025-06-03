<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Brand;
use \App\Models\Category;

class ProductController extends Controller
{
    public function index ()
    {
        return view('product.index');
    }

    public function create () 
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('product.create', compact('brands', 'categories'));
    }
}
