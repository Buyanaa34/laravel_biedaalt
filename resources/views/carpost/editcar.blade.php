@extends('layouts.apps');
<style>
    #buuz{
       text-align: left;
       font-size: 15px;
   }
   h1{
       text-align: center;
   }
</style>
@section('content')
<div style="text-align: center;justify-content:center;">
    <h1>Update a car post<h1>
        <br>
        {!! Form::open(['action'=>['carcontroller@update',$post->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('car_name','Car name')}}
                {{Form::text('car_name',$post->car_name,['class'=>'form-control','placeholder'=>'Car name'])}} 
            </div>
            <div class="form-group">
                {{Form::label('price','Price')}}
                {{Form::text('price',$post->price,['class'=>'form-control','placeholder'=>'Price'])}} 
            </div>
            <div class="form-group">
                {{Form::label('more_info','More information')}}
                {{Form::textarea('more_info',$post->more_info,['id'=>'editor1','class'=>'form-control','placeholder'=>'Body Text'])}} 
            </div>
            <div class="form-group" style="font-size: 25px;width:15% !important">
                {{Form::label('quantity','Type the new quantity')}}
                {{Form::text('quantity',$post->quantity,['class'=>'form-control','placeholder'=>'Quantity'])}}
            </div>
            <h3 style="text-align: left">Car Profile picture:</h3>
            <div id="buuz" class="form-group" style="font-size:20px;">
                {{Form::file('car_image')}}
            </div>
            <br>
            <h4 style="text-align: left">More pictures of the car:</h4>
            <div id="buuz" class="form-group" style="font-size:20px;">Picture 1:
                {{Form::file('more_pic1')}}
            </div>
            <div id="buuz" class="form-group" style="font-size:20px;">Picture 2:
                {{Form::file('more_pic2')}}
            </div>
            <div id="buuz" class="form-group" style="font-size:20px;">Picture 3:
                {{Form::file('more_pic3')}}
            </div>
            <div id="buuz" class="form-group" style="font-size:20px;">Picture 4:
                {{Form::file('more_pic4')}}
            </div>
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
</div>
@endsection 