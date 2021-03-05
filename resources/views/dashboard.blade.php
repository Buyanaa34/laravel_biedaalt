@extends('layouts.apps')
<style>
    body{
        background: url("/carental/public/storage/cover_images/background.png");
        background-repeat: no-repeat, repeat;
        background-size: auto;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border:none">
                <div class="card-header" style="background: #dadada;text-align:center;font-size:25px">
                    <img src="/carental/public/storage/cover_images/stat2.png" width="50px" height="50px" > 
                        <strong style="font-size: 45px">Dashboard</strong>
                        <img src="/carental/public/storage/cover_images/stat2.png" width="50px" height="50px" > 
                    </div>
                <div class="card-body" style="background: #dadada;width:100%">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->id!='30') {{-- hereglegch ni engiin user eswel staff permissiontoi baiwal --}}
                        @if (Auth::user()->isbanned==0&&Auth::user()->isadmined==0)
                            <a href="/carental/public/posts/create" class="btn btn-primary" style="margin-bottom: 20px">Create a comment</a>
                        @endif
                        <h3>Your comments</h3>
                        @if(count($data['posts'])>0)
                        <table class="table table-striped"  >
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($data['posts'] as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/carental/public/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action'=>['maincontroller@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
                            <p>You have no posts :(</p>
                        @endif
                        @if (Auth::user()->isadmined==0) {{--tuhain hereglegch ni admin erhgui bol --}}
                            <h3>Your orders</h3>          {{--Baraa awsan bol tuuniig haruulah--}}
                            <hr style="height: 5px;background:#ff6961">
                            @if(count($data['orders'])>0)
                                @foreach($data['orders'] as $order)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach ($order->cart->items as $item) 
                                            <li class="list-group-item">
                                                <span class="badge">{{$item['price']}} $</span>
                                                <img  style="width:50px;" src="/carental/public/storage/car_image/{{$item['item']['car_image']}}">
                                                {{$item['item']['car_name']}} | {{$item['qty']}} Units
                                                
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="panel-footer">
                                        <strong>Total Price: ${{$order->cart->totalPrice}} | 
                                            @if ($order->isorder_delivered=='0')
                                            Is Delivered ?
                                            <a href="{{route('delivery',['id' => $order->id])}}" class="btn btn-success">Yes</a>
                                            {{-- <a href="" class="btn btn-danger">No</a> --}}
                                            @else
                                                Hope u enjoy our product :)
                                            @endif
                                        </strong>
                                    </div>
                                    <hr style="height: 5px;background:#ff6961">
                                </div>
                                @endforeach
                            @else
                                <p>You have no orders yet </p>
                            @endif
                        @endif
                    @endif
                    @if(Auth::user()->isadmined=='1'){{-- hereglegch ni engiin user baiwal end --}} {{-- hereglegch ni admin eswel admin erhtei baiwal --}}
                        @if (Auth::user()->id=='30')
                            <h3>Web site users</h3>
                            @if(count($data['$S_users'])>0)
                            <table class="table table-striped">
                                @foreach($data['$S_users'] as $S_user)
                                @if ($S_user->id!='30')
                                <tr>
                                    <td>{{$S_user->name}}</td>
                                    <td>{{$S_user->email}} </td>
                                    <td><img  style="width:50px;" src="/carental/public/storage/cover_images/{{$S_user->profile_pic}}"></td>
                                    <td>
                                        {{-- {!!Form::open(['action'=>['Profilecontroller@destroy',$S_user->id],'method'=>'POST','class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Ban account',['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!} --}}
                                        
                                        @if ($S_user->isbanned!='1')
                                        <td>
                                            <button onclick="location.href='{{route('banuser',['id' => $S_user->id])}}'" class="btn btn-danger"><span>Ban account</span></button>
                                        </td>
                                        @else
                                        <td>
                                            <button onclick="location.href='{{route('banuser',['id' => $S_user->id])}}'" class="btn btn-success"><span>Unban account</span></button>
                                        </td>
                                        @endif
                                    </td>
                                    @if ($S_user->isadmined!='1')
                                    <td>
                                        <button onclick="location.href='{{route('permission_toggle',['id' => $S_user->id])}}'" class="btn btn-success"><span>Give staff permission</span></button>
                                    </td>
                                    @else
                                    <td>
                                        <button onclick="location.href='{{route('permission_toggle',['id' => $S_user->id])}}'"  class="btn btn-danger"><span>Take staff permission</span></button>
                                    </td>
                                    @endif
                                </tr>
                                    @endif
                                @endforeach
                            </table>
                            {{-- {{$data['$S_users']->links()}} --}}
                            @else
                                <p>This site have no users yet</p>
                            @endif
                            {{-- site-aas zahialsan buh baraani list --}}
                        @endif
                        <h3 style="margin-top: 100px">All orders</h3>      
                        <hr style="height: 5px;background:#ff6961">
                        @if(count($data['all_orders'])>0)
                            @foreach($data['all_orders'] as $order)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <ul class="list-group">
                                        @foreach ($order->cart->items as $item) 
                                        <li class="list-group-item">
                                            <span class="badge">{{$item['price']}} $</span>
                                            <img  style="width:50px;" src="/carental/public/storage/car_image/{{$item['item']['car_image']}}">
                                            {{$item['item']['car_name']}} | {{$item['qty']}} Units |
                                            by [ {{$order->user->name}} ] | at ( {{$order->created_at}} )
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <strong>Total Price: ${{$order->cart->totalPrice}} | Is Delivered ?
                                        @if ($order->isorder_delivered=='0')
                                        (NO)
                                        {{-- <a href="" class="btn btn-danger">No</a> --}}
                                        @else
                                            (YES)
                                        @endif
                                    </strong>
                                </div>
                                <hr style="height: 5px;background:#ff6961">
                            </div>
                            @endforeach
                        @else
                            <p>You have no orders yet </p>
                        @endif
                    @endif  {{-- hereglegch ni admin eswel admin erhtei baiwal end --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
