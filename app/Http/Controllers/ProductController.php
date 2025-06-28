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
    public function index (Request $request)
    {
        $products   = Product::query();
        $brands     = Brand::all();
        $categories = Category::all();

        $products = Product::with('category')
            ->orderBy('status_id')
            ->orderBy('category_id')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('description', 'like', '%' . $keyword . '%');
            })
            ->simplePaginate(10);

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
        $product = new Product();

        $validator = Validator::make($request->all(), [
            'description'   => 'required|string',
            'brand_id'      => ['required', 'exists:brands,id'],
            'category_id'   => ['required', 'exists:categories,id'],
            'purchaseValue' => 'required|string',
            'salePrice'     => 'required|string',
            'profitMargin'  => 'required|string',
            'numberUnits'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'create')
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

        request()->session()->flash('success', 'Produto Cadastrado com sucesso!');
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
                    ->where('status_id', '!=', Status::SUSPENSO)
                    ->orWhere('id', $query)
                    ->limit(10)
                    ->get(['id', 'description', 'salePrice']);

        return response()->json($products);
    }

    public function checkStockQuantity($id, Request $request) 
    {
        $produto = Product::findOrFail($id);

        $quantidadeDesejada = (int) $request->quantidadeDesejada;

        if ($produto->numberUnits >= $quantidadeDesejada) {
            return response()->json([
                'disponivel' => true
            ]);
        }

        return response()->json([
            'disponivel' => false,
            'estoqueDisponivel' => $produto->numberUnits
        ]);
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
