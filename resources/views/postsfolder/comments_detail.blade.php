@extends('layouts.apps')
<style>
	.button {
  		border-radius: 20px;
  		background-color:#ff6961;
  		border: none;
  		color: #e2e2ff;
  		font-size: 28px;
  		padding: 15px;
  		width: 100px;
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
<div style="text-align: center">
	<h1>{{$post->title}}</h1>
	<img  style="width:150px;" src="/carental/public/storage/cover_images/{{$post->cover_image}}">
    <hr>
    <div style="font-size: 20px;text-align:left !important">
        {!!$post->body!!}
    </div>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <br>
	<button onclick="location.href='/carental/public/posts'" class="button"><span>Back</span></button>
	@if(!Auth::guest())
		@if(Auth::user()->id==$post->user_id||Auth::user()->id=='30')
			@if (Auth::user()->id==$post->user_id)
				@if(Auth::user()->isbanned == '0')
					<button onclick="location.href='/carental/public/posts/{{$post->id}}/edit'" class="button"><span>Edit</span></button>
				@endif
			@endif
		</div>
		<div style="text-align: center">
			{!!Form::open(['action'=>['maincontroller@destroy',$post->id],'method'=>'POST','class'=>''])!!}
			{{Form::hidden('_method','DELETE')}}
			{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
			{!!Form::close()!!}
		</div>
		@endif
		@if(Auth::user()->id!=$post->user_id&&Auth::user()->id!='30')
		<div style="text-align: center">
			@if (Auth::user()->isbanned==0&&Auth::user()->isadmined==0)
				<button onclick="" class="button" id="rent" style="font-size: 22px"><span>Report</span></button>
				<script>
						document.getElementById('rent').onclick= function () {
						document.getElementById('basket_icon').src="/carental/public/storage/cover_images/iconselected.png";
						location.href="{{ route('report',['id'=>$post->id]) }}";
						};		
				</script>
			@endif
		</div>
		@endif
	@endif
@endsection





{{-- 
<a href="#" class="fancybutton">Back</a>{{-- href="/carental/public/posts" --}}  
{{-- <script>
    const buttons =document.querySelectorAll('a');
    buttons.forEach(btn => {
        btn.addEventListener('click',function(e){

            let x = e.clientX - e.target.offset().left;
            let y = e.clientY - e.target.offset().top;

            let ripples = docuemnt.createElement('span');
            ripples.setAttribute('id','fancyspan');
            ripples.style.left=x+'px';
            ripples.style.top=y+'px';
            btn.appendChild(ripples);
            setTimeout(()=>{
                ripples.remove()
            },1000);
        });
    });
</script>

--}}

