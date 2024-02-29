<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(){
        return view('products.index',['products'=>Product::get()]);
    }

    public function create(){
        return view('products.create');
    }
    public function store(Request $request){


        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'

        ]);

        $imageName = $request->image->getClientOriginalname();
        $request->image->storeAs('public/products/', $imageName);

        // dd($request->all());

        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess("Product added successfully !!");
        
    }

    public function edit($id){
        // dd($id);
        $product = Product::where('id',$id)->first();

        return view('products.edit',['product'=>$product]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'

        ]);

        $product = Product::where('id',$id)->first();

        if ($request->hasFile('image')) {
            Storage::delete('public/products/'.$product->image);
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/products/', $filename);
            $product->image = $filename;
        }


        // $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess("Product Updated successfully !!");
    }

    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess("Product Deleted Successfully");
    }

    public function show($id){
        $product = Product::where('id',$id)->first();
       return view('products.show',['product'=>$product]);
    }
}
