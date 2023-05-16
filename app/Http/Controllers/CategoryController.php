<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
            // $path = $request->file('image')->store('public/categories/images');
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
        $product = Category::find($id);
        $deleteOldImage = 'category/images/' . $product->image;
        if (file_exists($deleteOldImage)) {
            @unlink(public_path($deleteOldImage));
        }
        $product->delete();
        Session()->flash('msg', 'Product deleted');
        return redirect()->back();
    }
    public function edit_category($id){
        $category = Category::find($id);
        return view('edit_category', compact('category'));
    }
    public function update_category(Request $request, $id){
        $category=Category::find($id);
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
    public function check(){

        Storage::disk('local')->put('example.txt', 'Contents');

        // $numbers = range(1, 100);

        $numbers = [];
        for ($i = 0; $i < 100; $i++) {
            $numbers[] = random_int(1, 1000);
        }

        $even = [];
        $odd = [];
        foreach ($numbers as $number) {
            if ($number % 2 == 0) {
                $even[] = $number;
            } else {
                $odd[] = $number;
            }
        }
        echo "Even numbers: " . implode(",", $even);
        echo '<br>';
        echo "Odd numbers: " . implode(",", $odd);
    }
}
