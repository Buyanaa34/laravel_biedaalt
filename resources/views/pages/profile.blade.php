@extends('layouts.apps')
<style>
    .button {
            border-radius: 20px;
            background-color:#ff6961;
            border: none;
            color: #e2e2ff;
            font-size: 17px;
            width: 120px;
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
<div style="display: grid;grid-template-columns: repeat(2, 50%);">
    <div>
        <div class="show_profile" style="text-align: left;padding-left:20px">
            @if($hereglegch->isadmined==1&&$hereglegch->id!='30')
                <h4> <strong style="text-decoration: underline">You have STAFF permission</strong></h4>
                <br>
            @endif
            @if($hereglegch->isbanned==1)
                <h4> <strong style="text-decoration: underline;color:#ff6961">You are banned due to your bad behaivior.</strong></h4>
                <small style="color: #ff6961">You are no longer write comments or rent a cars until admin unbans you</small>
                {!! Form::open(array('action' => array('Profilecontroller@retrievemessage', $hereglegch->id))) !!}
                    <div class="form-group">
                        {{Form::label('Message','Message')}}
                        {{Form::text('message','',['class'=>'form-control','placeholder'=>'Title'])}} 
                    </div>
					{{Form::submit('Send message to admin',['class'=>'btn btn-primary'])}}
				{!! Form::close() !!}
                <br>
            @endif
            {!! Form::open(['action'=>['Profilecontroller@update',$hereglegch->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name','NAME')}}
                {{Form::text('name',$hereglegch->name,['class'=>'form-control1','placeholder'=>'Name'])}} 
            </div>
            <div class="form-group">
                {{Form::label('email','EMAIL')}}
                {{Form::text('email',$hereglegch->email,['class'=>'form-control1','placeholder'=>'Email'])}}
            </div>
            <div style="font-size:17px"><strong>Profile picture</strong> </div>
            <img  style="width:150px;" src="/carental/public/storage/cover_images/{{$hereglegch->profile_pic}}">
            <div id="buuz" class="form-group" style="font-size:20px;padding-top:10px">
                {{Form::file('profile_pic')}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit edited information',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        {!!Form::open(['action'=>['Profilecontroller@destroy',$hereglegch->id],'method'=>'POST','class'=>''])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete profile',['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
        </div>
    </div>
    <div>
        <h3 style="text-align: center;font-size:36px">You can change or edit your profile </h3>
        <hr>
        <img class="movin_pic" src="/carental/public/storage/cover_images/maleuserz.png" >
    </div>
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