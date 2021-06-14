<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'user';

    protected $fillable = [
        'name',
        'address',
        'LGA',
        'state',
        'email',
        'telephone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:5',
        'address' => 'required|min:12',
        'LGA' => 'required|min:3',
        'state' => 'required|min:3',
        'email' => 'required|min:12',
        'telephone' => 'required|min:2'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order','user_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public $timestamps = true;
}
