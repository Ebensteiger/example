<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //   return view('admin.login');
      
    // }

    

    public function create(Request $request){
      $this->validate($request,[
        'name'=>'required',
        'email'=>'required',
        'contact'=>'required',
        'password'=>'required'
      ]);

      $admin = new Admin;
        $admin->name = $request->name;
        $admin->email=$request->email;
        $admin->contact=$request->contact;
        $admin->password=$request->password;
        
          $admin->save();

          return response()->json([
            'status'=> true,
            'data' => $admin
          ]);

    }

    // public function auth(Request $request){
    //   $email = $request->post('email');
    //   $password = $request->post('password');

    //   $result = Admin::where([
    //     'email' => $email,
    //     'password' => $password 
    //   ])->
    //   if (isset($result['0']->id)){
    //     $request->session()->put('ADMIN_LOGIN', true);
    //     $request->session()->put('ADMIN_ID', $result['0']->id);
    //     return redirect('admin/{id}/dashboard');
    //   }
    //   else{
    //     $request->session()->flash('error', 'Please enter valid login details');
    //     return redirect('admin');
    //   }
    // }

    public function dashboard($id){
      $admin = Admin::find($id);

      return response()->json([
        'status'=> true,
        'data' => $admin
      ]);
    }

    public function update(Request $request, $id){
      $admin = Admin::find($id);

      $admin->name = $request->name;
      $admin->email = $request->email;
      $admin->contact = $request->contact;
      $admin->password = $request->password;

      $admin->save();

      return response()->json([
        'status'=> true,
        'success' => 'Update successful',
        'data' => $admin
      ]);
    }
    

    public function updatePassword(Request $request, $id){
      $admin = Admin::find($id);

      $admin->password = $request->password;

      $admin->save();

      return response()->json([
        'status'=> true,
        'success' => 'Update successful',
        'data' => $admin
      ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
   

}
