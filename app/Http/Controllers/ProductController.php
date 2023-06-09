<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ProductController extends Controller
{
    public function all_product(){
        // $products = Product::all();
        $products = Product::with('images')->get();
        return view('products.all_product', compact('products'));
    }
    public function category_product($id){
        $products = Product::where('category_id', $id)->get();
        return view('products.category_product', compact('products'));
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
            'images.*' => 'required|mimes:png,jpg,jpeg',
        ]);
        $p_id=Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'color' => $request->color,
            'size' => $request->size,
        ]);
        $images = $request->file('images');
        foreach ($images as $image) {
            // $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // $image->storeAs('public/products/images', $imageName);
            $path = Storage::disk('public')->put('products/images', $image);

            Image::create([
                'name' => $path,
                'product_id' => $p_id->id,
            ]);
            //  dd($path);
        }





        Session()->flash('msg','Product added successfully');
        return redirect()->back();
    }
    public function image_product($id){
        $images = Image::where('product_id', $id)->get();
        return view('products.image_product', compact('images'));
    }
    public function delete_product($id){
        $product = Product::find($id);
        $images=Image::where('product_id', $id)->get();
        foreach ($images as $image){
            $deleteOldImage = $image->name;
            @unlink(public_path($deleteOldImage));
        }

        $product->images()->delete();
        $product->delete();
        Session()->flash('msg', 'Product deleted');
        return redirect()->back()->setStatusCode(302);
    }
    public function edit_product($id){
        $product = Product::find($id);
        $images = Image::with('product')->where('product_id',$id);
        $categories = Category::all();
        return view('products.edit_product', compact('product','images','categories'));
    }
    public function update_product(Request $request, $id){
        // $product=Product::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'color' => 'required',
            'size' => 'required',
            'images.*' => 'required|mimes:png,jpg,jpeg',
        ]);
        $images=Image::where('product_id', $id)->get();
        foreach ($images as $image){
            $deleteOldImage = $image->name;
            if (file_exists($deleteOldImage)) {
                @unlink(public_path($deleteOldImage));
            }
            $image->delete();
        }
        Product::where('id', $id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'color' => $request->color,
            'size' => $request->size,
        ]);


        $images = $request->file('images');
        foreach ($images as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/images', $imageName);

            Image::create([
                'name' => 'storage/products/images/' . $imageName,
                'product_id' => $id,
            ]);
        }
        Session()->flash('msg', 'Product Updated Success');
        return redirect()->back();
    }
    // public function images_destroy(){
    //     return('working');
    // }

}




