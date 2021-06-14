<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'product';

    protected $fillable = [
        'categories_id',
        'title',
        'description',
        'price',
        'availability',
        'image'
    ];
    
    public static $rules = [
        'categories_id' => 'required|integer',
        'title' => 'required|min:2',
        'description' => 'required|min:20',
        'price' => 'required|numeric',
        'availability' => 'required|integer|min:0|max:1',
        'image' => 'required|image|mimes: jpeg, jpg,bmp,png,gif'
    ];
      
    public function category() {
      return $this->belongsTo('App\Models\Category','categories_id');
    }
    public function orders() {
        return $this->hasMany('App\Models\Order', 'product_id');
    }
    public $timestamps = true;
}