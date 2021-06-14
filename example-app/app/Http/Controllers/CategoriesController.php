<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
          'name'=>'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        
          $category->save();

          return response()->json([
            'status'=> true,
            'data' => $category
          ]);

        
    }

    public function categories(){
      return response()->json([
        'status'=> true,
        'data' => Category::all()
      ]);
    }

    public function getSingleCategory($id){
      $category = Category::find($id);

      return response()->json([
        'status'=> true,
        'data' => $category
      ]);
    }

    public function getCategoryProducts(Request $request, $id){
      $category = Category::find($id);
      $category_products = $category->products->where('categories_id', $id)->get();
      
      return response()->json([
        'status'=> true,
        'data' => $product
      ]);
      
    }

    public function update($id, Request $request){
      $category = Category::find($id);

      $category->name = $request->name;

      $category->save();

      return response()->json([
        'status'=> true,
        'message' => 'Update messageful',
        'data' => $category
      ]);
    }

    public function delete($id){
      $category = Category::findorfail($id)->delete();

      return response()->json([
        'status'=> true,
        'message' => 'Delete messageful',
      ], 200);
    }

   

}