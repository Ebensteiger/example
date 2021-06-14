<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   

    public function create(Request $request)
    {
        $this->validate($request,[
          'name'=>'required',
          'address'=>'required',
          'LGA' => 'required',
          'state' => 'required',
          'email'=>'required',
          'telephone'=>'required',
          'order'=>'present|array',
        ]);

        $user = new User;
       
        $user->name = $request->name;
        $user->address = $request->address;
        $user->LGA = $request->LGA;
        $user->state = $request->state;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
      
        
        $user->save();

        $order = [];
        $collection = collect($request->order);
        $user_orders = $collection->map(function ($orders) use($order, $user) {
          $order = [
              'user_id' => $user->id,
              'product_id' => $orders['product_id'],
              'product' => $orders['product'],
              'price' => $orders['price'],
              'quantity' => $orders['quantity'],
              'status' => $orders['status'],
              'totalAmount' => $orders['totalAmount'],
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ];
        return $order;
        });
        Order::insert($user_orders->toArray());
        
        return response()->json([
           'status'=> true,
           'data' => $user_orders
        ]);

        
    }

    public function order(){
      return response()->json([
        'status'=> true,
        'data' => Order::all()
      ]);
    }

    public function getSingleOrder($id){
      $order = Order::find($id);

      return response()->json([
        'status'=> true,
        'data' => $order
      ]);
    }

    public function update(Request $request, $id){
        $order = Order::find($id);
  
        $order->product_id = $request->product_id;
        $order->name = $request->name;
        $order->address = $request->address;
        $order->LGA = $request->LGA;
        $order->state = $request->state;
        $order->email = $request->email;
        $order->telephone = $request->telephone;
        $order->product = $request->product;
        $order->price = $request->price;
        $order->quantity = $request->quantity;
        $order->status = $request->status;
        $order->total = $request->total;

        if ($order->status == 0){
          $order->status = 'Pending';
        }
        else if ($order->status == 1){
          $order->status = 'Delivered';
        }
        else{
          $order->status = 'Cancelled';
        }
  
        $order->save();
  
        return response()->json([
          'status'=> true,
          'message' => 'Update successful',
          'data' => $order
        ]);
    }

    public function count(){
      $collection = Order::all();
      $counted = $collection->count();
      $pending = $collection->where('status', 'Pending')->count();
      $delivered = $collection->where('status', 'Delivered')->count();
      $cancelled = $collection->where('status', 'Cancelled')->count();
      $pend = $collection->where('status', 'Pending');
      $del = $collection->where('status', 'Delivered');
      $can = $collection->where('status', 'Cancelled');
      $tamount = $collection->sum('total');
      $pamount = $pend->sum('total');
      $damount = $del->sum('total');
      $camount = $can->sum('total');
      
      return response()->json([
        'status'=> true,
        'data' => [$counted, $pending, $delivered, $cancelled, $tamount, $pamount, $damount, $camount]
      ]);
    }

    public function use($id){
      $order = Order::find($id);

      $name = $order->name;
      $address = $order->address;
      $lga = $order->LGA;
      $state = $order->state;
      $email = $order->email;
      $telephone = $order->telephone;

      $user = new User();
      $user->name = $name;
      $user->address = $address;
      $user->LGA = $lga;
      $user->state = $state;
      $user->email = $email;
      $user->telephone = $telephone;
      $user->save();
      
      return response()->json([
        'status'=> true,
        'success' => 'Update successful',
        'data' => $user
      ]);
    }

    
}
