<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
          'title'=>'required',
          'description'=>'required',
          'price'=>'required',
          'availability'=>'required',
          'image'=>'required'
        ]);

        $product = new Product;
        $product->categories_id = $request->categories_id;
        $product->title = $request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->availability=$request->availability;
        $product->image=$request->image;
        
          $product->save();

          return response()->json([
            'status'=> true,
            'data' => $product
          ]);

        
    }

    public function getAllProducts(){
      return response()->json([
        'status'=> true,
        'data' => Product::all()
      ]);
    }

    public function getSingleProduct($id){
      $product = Product::find($id);

      return response()->json([
        'status'=> true,
        'data' => $product
      ]);
    }

    public function getProductWithCategory($cat_id)
    { 
     
      $products = Product::where('categories_id' , $cat_id)->with(['category:id,name'])->get();


      return response()->json([
        'status'=> true,
        'data' => $products
      ]);
    }

    public function updateProduct(Request $request, $id){
      $product = Product::find($id);

      $product->categories_id = $request->categories_id;
      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->availability = $request->availability;
      $product->image = $request->image;

      $product->save();

      return response()->json([
        'status'=> true,
        'message' => 'Update messageful',
        'data' => $product
      ]);
    }

    public function delete($id){
      $product = Product::findorfail($id)->delete();

      return response()->json([
        'status'=> true,
        'message' => 'Delete messageful',
      ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
   

}