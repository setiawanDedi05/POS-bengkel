<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = DB::table('products')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%'.$name.'%');
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.product.index', compact('products'));
    }

    public function create(){
        return view('pages.product.create');
    }

    public function store(StoreProductRequest $request) {
        $data = $request->all();
        \App\Models\Product::create($data);
        return redirect()->route('product.index')->with('success', 'Produk berhasil dibuat');
    }

    public function edit($id) {
        $product = \App\Models\Product::findOrFail($id);
        return view('pages.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product) {
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'Produk berhasil diedit');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus');
    }
}
