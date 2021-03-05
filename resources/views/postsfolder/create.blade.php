@extends('layouts.apps');

@section('content')
<div style="text-align: center">
    <h1>Create Post<h1>
        <br>
        {!! Form::open(['action'=>'maincontroller@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}} 
            </div>
            <div class="form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body','',['id'=>'editor1','class'=>'form-control','placeholder'=>'Body Text'])}} 
            </div>
            <div id="buuz" class="form-group" style="font-size:20px;">
                {{Form::file('cover_image')}}
            </div>
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
</div>
@endsection 