<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'product_id',
        'name',
        'address',
        'LGA',
        'state',
        'email',
        'telephone',
        'product',
        'price',
        'quantity',
        'status',
        'total'
    ];
    
    public static $rules = [
        'product_id' => 'required|integer',
        'name' => 'required|min:5',
        'address' => 'required|min:12',
        'LGA' => 'required|min:3',
        'state' => 'required|min:3',
        'email' => 'required|min:12',
        'telephone' => 'required|min:2',
        'product' => 'required|min:2',
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'status' => 'required|numeric',
        'total' => 'required|numeric'
    ];

    public function product() {
        return $this->belongsTo('App\Models\Product','product_id');
      }
      public function users() {
          return $this->hasMany('App\Models\User', 'user_id');
      }
      
    
    public $timestamps = true;
}
