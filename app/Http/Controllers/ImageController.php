<?php

namespace App\Http\Controllers;

use File;
use App\Image;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageController extends Controller
{
    public function index()
    {
        $image = Image::with(['product'])->orderBy('created_at', 'DESC');
        $product = Product::orderBy('name', 'DESC')->get();
        if (request()->product_id != '') {
            $image = $image->where('product_id', request()->product_id);
        }
        $image = $image->paginate(10);
        return view('image.index', compact('image','product'));
    }

    public function create()
    {
        $product = Product::orderBy('name', 'DESC')->get();
        return view('image.create', compact('product'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'warna' => 'required|string|max:100',
            'product_id' => 'required|exists:products,id',
            'uploadedFileUrl'=>'required'
        ]);
        
        
        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();
            $image = Image::create([
                'warna' => $request->warna,
                'slug' => $request->warna,
                'product_id' => $request->product_id,
                'uploadedFileUrl' => $uploadedFileUrl
            ]);
            return redirect(route('image.index'))->with(['success' => 'Gambar Baru Ditambahkan']);
        
    }

    public function edit($id)
    {
        $image = Image::find($id);
        $product = Product::orderBy('name', 'DESC')->get();
        return view('image.edit', compact('product', 'image'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'warna' => 'required|string|max:100',
            'product_id' => 'required|exists:products,id',
        ]);

        $image = Image::find($id);

        $image->update([
            'warna' => $request->warna,
            'product_id' => $request->product_id,
        ]);
        return redirect(route('image.index'))->with(['success' => 'Gambar Diperbaharui']);
    }

    public function destroy($id)
    {
        $image = Image::find($id);
        
        $image->delete();
        return redirect(route('image.index'))->with(['success' => 'Gambar Sudah Dihapus']);
    }

} 