<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Brand;
use \App\Models\Category;

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
}
