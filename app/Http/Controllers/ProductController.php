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
        $products = Product::all();
        
        return view('product.index', compact('brands', 'categories', 'products'));
    }

    public function create () 
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('product.create', compact('brands', 'categories'));
    }

    public function store (Request $request)
    {
        $data = $request->validate([
            'description'   => 'required|string',
            'brand_id'      => ['required', 'exists:brands,id'],
            'category_id'   => ['required', 'exists:categories,id'],
            'purchaseValue' => 'required|string',
            'salePrice'     => 'required|string',
            'profitMargin'  => 'required|string',
            'numberUnits'   => 'required|integer'
        ]);

        $data['purchaseValue']  = formatToDecimal($data['purchaseValue']);
        $data['salePrice']      = formatToDecimal($data['salePrice']);
        $data['profitMargin']   = formatToDecimal($data['profitMargin']);

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('status', 'Produto cadastro com sucesso!');
    }

    public function search(Request $request) 
    {
        $query = $request->input('searchTerm');

        $products = Product::where('description', 'LIKE', "%{$query}%")
                       ->orWhere('id', $query)
                       ->limit(10)
                       ->get(['id', 'description']);

        return response()->json($products);
    }
}
