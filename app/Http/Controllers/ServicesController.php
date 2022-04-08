<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        // Get - get all data from database
        // $products = Product::paginate(2)
        // $products = Product::limit(10)
        $products = Services::all();
        return response()->json($products);
    }


    // public function create()
    // {

    // }


    public function store(Request $request)
    {
        // Post - push data to database
        // validate
        $this->validate($request,[
            'title'=>'required',
            'price'=>'required',
            'photo'=>'required',
            'description'=>'required'
        ]);
        $product = new Product();

        //image data
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedfileExtention = ['pdf','jpg','png'];
            $extention = $file->getClientOriginalExtension();
            $check = in_array($extention,$allowedfileExtention);

            if($check){
                $name=time() . $file->getClientOriginalName();
                $file->move('images',$name);
                $product->photo=$name;
            }
        }

        //text data
        //database column title
        $product->title = $request->input('title'); 
        $product->price = $request->input('price'); 
        $product->description = $request->input('description');
        
        $product->save();

        return response()->json($product);
    }


    public function show($id)
    {
        //give one item from product table
        $product = Product::find($id);
        return response()->json($product);
    }


    // public function edit($id)
    // {

    // }


    public function update(Request $request, $id)
    {
        // Update by id
        $this->validate($request,[
            'title'=>'required',
            'price'=>'required',
            'photo'=>'required',
            'description'=>'required'
        ]);
        $product = Product::find($id);

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedfileExtention = ['pdf','jpg','png'];
            $extention = $file->getClientOriginalExtension();
            $check = in_array($extention,$allowedfileExtention);

            if($check){
                $name=time() . $file->getClientOriginalName();
                $file->move('images',$name);
                $product->photo=$name;
            }
        }

        $product->title = $request->input('title'); 
        $product->price = $request->input('price'); 
        $product->description = $request->input('description');
        
        $product->save();

        return response()->json($product);

    }


    public function destroy($id)
    {
        // Delete by id
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product Deleted Successfully.');
    }
}