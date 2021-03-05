<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function posts(){
        return $this->hasMany('App\postmodel');
    }
    public function car_posts(){
        return $this->hasMany('App\car_postmodel');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function individual_car(){
        return $this->hasMany('App\individual_car');
    }

    public function messages(){
        return $this->hasMany('App\messages');
    }
}
