@extends('layouts.apps')
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
    <h1>Edit Post<h1>
        {!! Form::open(['action'=>['maincontroller@update',$post->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}} 
            </div>
            <div class="form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body',$post->body,['id'=>'editor1','class'=>'form-control','placeholder'=>'Body Text'])}} 
            </div>
            <div id="buuz" class="form-group" style="font-size:20px;">
                {{Form::file('cover_image')}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
@endsection 