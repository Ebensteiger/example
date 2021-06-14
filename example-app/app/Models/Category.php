<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $table = 'categories';
    
    public static $rules = [
        'name' => 'required|min:3'
    ];
    
    public function products() {
      return $this->hasMany('Product','categories_id');
      
    }
    public function admin() {
      return $this->belongsTo('Admin','admin_id');
    }
    public $timestamps = true;    
}