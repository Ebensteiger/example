<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request,[
          'name'=>'required',
          'address'=>'required',
          'LGA' => 'required',
          'state' => 'required',
          'email'=>'required',
          'telephone'=>'required'
        ]);

        $user = new user;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->LGA = $request->LGA;
        $user->state = $request->state;
        $user->email = $request->email;
        $user->telephone = $request->telephone;

        
        
        $user->save();

        return response()->json([
          'status'=> true,
          'data' => $user
        ]);

        
    }

    public function user(){
      return response()->json([
        'status'=> true,
        'data' => user::all()
      ]);
    }
    //   $max = user::where('status', 'Delivered')->userBy('total', 'desc')->take(10)->get();
    //   $fetch_deleted = user::where('deleted_at' )
    //   return response()->json([
    //     'status'=> true,
    //     'data' => $max
    //   ]); 

    public function getSingleuser($id){
      $user = user::find($id);

      return response()->json([
        'status'=> true,
        'data' => $user
      ]);
    }

    public function update(Request $request, $id){
        $user = user::find($id);
  
        $user->name = $request->name;
        $user->address = $request->address;
        $user->LGA = $request->LGA;
        $user->state = $request->state;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
  
        $user->save();
  
        return response()->json([
          'status'=> true,
          'message' => 'Update successful',
          'data' => $user
        ]);
    }

    
}
