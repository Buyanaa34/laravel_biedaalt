<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->id!='30'){ //hereglegch ni admin bish bol
            $user_id=auth()->user()->id;
            $user=User::find($user_id);
            $data['orders'] = Auth::user()->orders;
            $data['orders'] -> transform(function($order,$key){
                $order->cart = unserialize($order->cart);
                return $order;
            });
            $data['posts']=$user->posts;
        }
        if(auth()->user()->isadmined=='1'){ //hereglegch ni admin bol
            $data['all_orders'] = Order::orderBy('id','desc')->paginate(5);
            $data['all_orders'] -> transform(function($order,$key){
                $order->cart = unserialize($order->cart);
                return $order;
            });
            $data['$S_users']= User::orderBy('id','desc')->paginate(5);
        }
        return view('dashboard')->with('data',$data);
    }
}
