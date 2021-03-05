<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo('App\user');
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    // public function cart(){
    //     return $this->hasMany('App\Cart');
    // }

    
}
