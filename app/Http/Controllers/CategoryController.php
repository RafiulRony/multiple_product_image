<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function all_categories(){
        $categories = Category::all();
        return view('categories',compact('categories'));
    }
    public function add_new_category(){
        return view('add_new_category');
    }
    public function store_category(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        $imageName = '';
        // $image=$request->image;
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('public/categories/images');
            $imageName = time().'_'.uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('category/images',$imageName);
            // Storage::move($path, 'public/categories/images/' . $imageName);
        }
        Category::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);
        Session()->flash('msg','Category Added Successfully');
        return redirect()->back();
    }
    public function delete_category($id){
        $product = Category::findOrFail($id);
        $deleteOldImage = 'category/images/' . $product->image;
        if (file_exists($deleteOldImage)) {
            @unlink(public_path($deleteOldImage));
        }
        $product->delete();
        Session()->flash('msg', 'Product deleted');
        return redirect()->back();
    }
    public function edit_category($id){
        $category = Category::findOrFail($id);
        return view('edit_category', compact('category'));
    }
    public function update_category(Request $request, $id){
        $category=Category::findOrFail($id);
        $request->validate([
            'name' => 'required',
        ]);
        $imageName = '';
        $deleteOldImage = 'category/images/' . $category->image;
        if ($image = $request->file('image')) {
            @unlink(public_path($deleteOldImage));
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('category/images', $imageName);
        } else {
            $imageName = $category->image;
        }
        Category::where('id', $id)->update([
            'name' => $request->name,
            'image' => $imageName,
        ]);
        Session()->flash('msg', 'Product Updated Success');
        return redirect()->back();
    }
}
