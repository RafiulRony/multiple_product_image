<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all_product($id){
        $products = Product::where('category_id', $id)->get();
        return view('products.all_product', compact('products'));
    }
    public function add_product(){
        return view('products.add_product');
    }
    public function store_product(Request $request){
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'color' => 'required',
            'size' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        $p_id=Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'color' => $request->color,
            'size' => $request->size,
        ]);
        $imageName = '';
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/images', $imageName);
        }
        Image::create([
            'name' => $imageName,
            'product_id' => $p_id->id,
        ]);

        Session()->flash('msg','Product added successfully');
        return redirect()->back();
    }
    public function image_product($id){
        $images = Image::where('product_id', $id)->get();
        return view('products.image_product', compact('images'));
    }
}
