<?php

namespace App\Http\Controllers;

use File;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with(['category'])->orderBy('created_at', 'DESC');
        $category = Category::orderBy('name', 'DESC')->get();
        if (request()->category_id != '') {
            $product = $product->where('category_id', request()->category_id);
        }
        $product = $product->paginate(10);
        return view('products.index', compact('product','category'));
    }

    public function create()
    {
        $category = Category::orderBy('name', 'DESC')->get();
        return view('products.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price_cents' => 'required|integer'
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->slug = $request->input('name');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->price_cents = $request->input('price_cents');
        if($file = $request->file('model'))
        {
            $model = Cloudinary::upload($request->file('model')->getRealPath())->getSecurePath();
            $product->model=$model;
        }
        $product->save();
            return redirect(route('product.index'))->with(['success' => 'Produk Baru Ditambahkan']);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::orderBy('name', 'DESC')->get();
        return view('products.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price_cents' => 'required|integer',
        ]);
        
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->slug = $request->input('name');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->price_cents = $request->input('price_cents');
        if($file = $request->file('model'))
        {
            $model = Cloudinary::upload($request->file('model')->getRealPath())->getSecurePath();
            $product->model=$model;
        }
        $product->save();
        return redirect(route('product.index'))->with(['success' => 'Data Produk Diperbaharui']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product.index'))->with(['success' => 'Produk Dihapus!']);
        
    }

} 