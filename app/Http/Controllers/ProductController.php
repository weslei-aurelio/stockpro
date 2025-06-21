<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Brand;
use \App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Validator;
use App\Models\Status;

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

        request()->session()->flash('success', 'Produto Cadastrado com Sucesso');
        return redirect()->route('products.index');
    }

    public function update(Product $product, Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'description'       => 'required|string',
            'brand_id'          => ['required', 'exists:brands,id'],
            'category_id'       => ['required', 'exists:categories,id'],
            'purchaseValue' => 'required|string',
            'salePrice'     => 'required|string',
            'profitMargin'  => 'required|string',
            'numberUnits'       => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $product->description   = $request->description;
        $product->brand_id      = $request->brand_id;
        $product->category_id   = $request->category_id;
        $product->purchaseValue = formatToDecimal($request->purchaseValue);
        $product->salePrice     = formatToDecimal($request->salePrice);
        $product->profitMargin  = formatToDecimal($request->profitMargin);
        $product->numberUnits   = $request->numberUnits;

        $product->save();

        request()->session()->flash('success', 'Produto atualizado com sucesso!');
        return redirect()->route('products.index');
    }

    public function search(Request $request) 
    {
        $query = $request->input('searchTerm');

        $products = Product::where('description', 'LIKE', "%{$query}%")
                       ->orWhere('id', $query)
                       ->limit(10)
                       ->get(['id', 'description', 'salePrice']);

        return response()->json($products);
    }

    public function inactivate(Product $product)
    {
        $product->status_id = Status::SUSPENSO;
        $product->save();

        request()->session()->flash('success', 'Produto inativado com sucesso!');
        return redirect()->route('products.index');
    }

    public function activate(Product $product)
    {
        $product->status_id = Status::ATIVO;
        $product->save();

        request()->session()->flash('success', 'Produto ativado com sucesso!');
        return redirect()->route('products.index');
    }
}
