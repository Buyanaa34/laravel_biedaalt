@extends('layouts.apps')
<style>
    .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ff6961;text-decoration: none}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
    
    
    
    
    .mdk{
        animation-name: fade_in;
        animation-duration: 2s;
        animation-fill-mode: forwards;
    }

@keyframes fade_in { 
    from {
        opacity: 0;
        padding-left: 400px;
        
    }
    to {
        opacity: 1;
        padding-left: 0px;
        
    }
    }
    .button {
            border-radius: 20px;
            background-color:#ff6961;
            border: none;
            color: #e2e2ff;
            font-size: 20px;
            width: 150px;
            transition: all 0.7s;
            cursor: pointer;
            margin: 2px;
            padding: 2px;
            }
        .button span {
            border-radius: 50%;
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
            }
            
        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
            }

        .button:hover span {
            padding-right: 25px;
            }

        .button:hover span:after {
            opacity: 1;
            right: 0;
		}
</style>
@section('content')
    {{-- <div class="hugatsaa" style="text-align:center;background-color: #636363;height:40px;color:#dadada;padding-top:10px">
        <div style="font-size: 15px" class="mdk">
            The renting process will expire in 
            <span id="time" style="color: #ff6961 ">08:00</span> if you wont buy it or leaving this page without any progress and it also will be expire
        </div>
        <script>
            function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;
                if (--timer < 0) {
                    timer = duration;
                }
                if(minutes==0&&seconds==0){
                    window.location.replace("http://localhost:82/carental/public/car_posts");
                }
            }, 1000);
        }
        window.onload = function () {
            var fiveMinutes = 60 * 8,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };
        </script>
    </div>
    <div > --}}
        <div class="mdk" style="text-align: center;font-size:40px;margin-top:30px">The products that u put inside your cart/basket</div>
        <hr>
        @if(Session::has('cart'))
            <div class="row">
                <div style="justify-content: center;">
                    <ul class="list-group">
                        @foreach($products as $product)
                            <div>
                                <strong style="font-size:23px;">{{$product['item']['car_name']}}</strong>
                                <img  style="width:150px;" src="/carental/public/storage/car_image/{{$product['item']['car_image']}}">
                                <span class="label label-success">Price:{{$product['price']}}$</span>
                                    <div class="dropdown">
                                        <button class="dropbtn" style="width: 200px;height:50px">Action</button>
                                        <div class="dropdown-content">
                                        <a href="{{route('reducebyone',['id' => $product['item']['id']])}}">Reduce by 1</a>
                                        <a href="{{route('removeitem',['id' => $product['item']['id']])}}">Reduce All</a>
                                        </div>
                                    </div>
                                <span class="label label-success" style="background:gray;color:#dadada">Quantity:{{$product['qty']}}</span>
                            </div>
                            <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <strong>Total:{{$totalPrice}}$</strong> 
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <button onclick="javascript:myfunction()" class="button"><span>Submit rent</span></button>
                        <script>
                            function myfunction(){
                                location.href="{{ route('checkout') }}";
                            }
                        </script>
                </div>
            </div>
        @else
            <h3  style="text-align: center;margin-top:50px;margin-bottom:120px;">No items in basket/cart</h3>
        @endif
    </div>
    <div class="box-areaz">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</div>
@endsection