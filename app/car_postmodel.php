<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class car_postmodel extends Model
{
    protected $table='car_posts';
    public $primaryKey='id';
    public $timestamps=true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function individual_car(){
        return $this->belongsTo('App\individual_car');
    }

}
