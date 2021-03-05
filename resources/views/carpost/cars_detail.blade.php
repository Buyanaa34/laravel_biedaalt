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
	
	<div>
		<h1>Name:{{$data['post']->car_name}}</h1>
		<img  style="width:150px;" src="/carental/public/storage/car_image/{{$data['post']->car_image}}">
		<br>
		<button  id="MORE" class="button"><span>More</span></button>
	</div>
	<section style="height: 100vh;padding:100px;display:none" id="galleryz" class="button">
		<div class="img_container">
			<div class="boxx">
				<div class="imgBx">
					<img src="/carental/public/storage/car_image/{{$data['post']->pic1}}">
				</div>
			</div>
			<div class="boxx">
				<div class="imgBx">
					<img src="/carental/public/storage/car_image/{{$data['post']->pic2}}">
				</div>
			</div>
			<div class="boxx">
				<div class="imgBx">
					<img src="/carental/public/storage/car_image/{{$data['post']->pic3}}">
				</div>
			</div>
			<div class="boxx">
				<div class="imgBx">
					<img src="/carental/public/storage/car_image/{{$data['post']->pic4}}">
				</div>
			</div>
		</div>
	</section>
	<script>
		const imgBx = document.querySelectorAll('.imgBox');
		imgBx.forEach(popup=> popup.addEventListener('click',()=>{
			popup.classList.toggle('active')
		}));
	</script>
	<script>
		var button = document.getElementById('MORE'); // Assumes element with id='button'
		var do_below=false;
		button.onclick = function() {
		var sect = document.getElementById('galleryz');
		if (sect.style.display != 'none') {//gallery-g alga bolgono
			do_below=true;
			document.getElementById('galleryz').className ='nothing';
			sect.addEventListener("animationend", endanimation);
			function endanimation(){
					if(do_below){// endanimation function ni gallery tomorj bas jijgerhed 2lan deer ni duudagdaj bga ba display='none' utgiig huseegui ued uguud bsn uchir do_below utgig ugsun	
						sect.style.display = 'none';//herew do_below unen bol doorh ymnudig hiine hudla bol hiihk
						button.innerHTML='More';
					}
				//if(sect.style.height != '100'){
				//	sect.style.display = 'none';
				//button.innerHTML='More';
				//}
			}
		}
		else {//galleryg gargaj irne
			do_below=false;
			sect.style.display = 'block';
			document.getElementById('galleryz').className ='galleryz';
			button.innerHTML='Hide';
		}
	}
	</script>
	<div style="padding-top: 70px">
		<div style="font-size: 20px;padding-top:30px;">Price:
			{{$data['post']->price}}$
		</div>
		@if ($data['post']->dummy_quantity=='0')
			<div style="font-size: 20px" id="availableornot">This car is not available right now</div>
		@else
			<div style="font-size: 20px" id="availableornot">This car is available right now</div>
		@endif
		<h4 style="font-size: 20px">Quantity:{{$data['post']->dummy_quantity}}</h4>
		<div style="font-size: 20px;text-align:left !important">
			{!!$data['post']->more_info!!}
		</div>
		<small>Uploaded(Updated) on {{$data['post']->created_at}}</small>	
		<br>
		<button onclick="location.href='/carental/public/car_posts'" class="button"><span>Back</span></button>
		@if(!Auth::guest())
			@if(Auth::user()->id=='30'||Auth::user()->isadmined=='1')
				<button onclick="location.href='/carental/public/car_posts/{{$data['post']->id}}/edit'" class="button"><span>Edit</span></button>
				<div style="text-align:center;height:50px;">
				{!!Form::open(['action'=>['carcontroller@destroy',$data['post']->id],'method'=>'POST','class'=>''])!!}
				{{Form::hidden('_method','DELETE')}}
				{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
				{!!Form::close()!!}
				</div>
			@endif
			@if(Auth::user()->id!='30')
				@if (Auth::user()->isadmined!='1')
					@if (Auth::user()->isbanned == '0')
						@if ($data['post']->dummy_quantity!='0')
						{{-- {!!Form::open(['action'=>['carcontroller@destroy',$data['post']->id],'method'=>'POST','class'=>''])!!}
							{{Form::label('rent_quantity','Enter the quantity of the product that you want to rent')}}
							{{Form::text('rent_quantity','',['class'=>'form-control','placeholder'=>$data['post']->dummy_quantity])}} 
						{!!Form::close()!!} --}}
						<button class="button" id="rentz"><span>Rent</span></button>
						<script>
							document.getElementById('rentz').onclick= function () {
							document.getElementById('basket_icon').src="/carental/public/storage/cover_images/iconselected.png";
							location.href="{{ route('buuz',['id'=>$data['post']->id]) }}";  
							};		
						</script>
						@endif
					@endif
				@endif
					@if(Auth::user()->isbanned == '1')
					<small style="color: #ff6961">Your account has banned due to your bad behavior</small>
				@endif
			@endif
			@if ($data['rate']=='1')    {{-- herwee hereglegch ni tuhain mashinii owner mun bol --}}
				<h2>Rate:</h2>
				<small style="color: #ff6961">Warning: You can only rate your product once !!</small>
				<div class="star_uud">
					<span class="fa fa-star" id="lol1"></span>
					<span class="fa fa-star" id="lol2"></span>
					<span class="fa fa-star" id="lol3"></span>
					<span class="fa fa-star" id="lol4"></span>
					<span class="fa fa-star" id="lol5"></span>
				</div>
				<div id="tailbar" style="text-align: center;font-size:15px"></div>
				<div style="display: none" id="dummy"></div>
				<script>
					var rate = 0;
					var lol1 = document.getElementById('lol1');
					var lol2 = document.getElementById('lol2');
					var lol3 = document.getElementById('lol3');
					var lol4 = document.getElementById('lol4');
					var lol5 = document.getElementById('lol5');
					lol1.onclick=function(){
						document.getElementById('lol1').className="fa fa-star checked";
						document.getElementById('lol2').className="fa fa-star";
						document.getElementById('lol3').className="fa fa-star";
						document.getElementById('lol4').className="fa fa-star";
						document.getElementById('lol5').className="fa fa-star";
						document.getElementById('tailbar').innerHTML="Product was very bad";
						rate=1;
						document.getElementById('textshit').value=rate;
					}
					lol2.onclick=function(){
						document.getElementById('lol1').className="fa fa-star checked";
						document.getElementById('lol2').className="fa fa-star checked";
						document.getElementById('lol3').className="fa fa-star";
						document.getElementById('lol4').className="fa fa-star";
						document.getElementById('lol5').className="fa fa-star";
						document.getElementById('tailbar').innerHTML="Product was bad";
						rate=2;
						document.getElementById('textshit').value=rate;
					}
					lol3.onclick=function(){
						document.getElementById('lol1').className="fa fa-star checked";
						document.getElementById('lol2').className="fa fa-star checked";
						document.getElementById('lol3').className="fa fa-star checked";
						document.getElementById('lol4').className="fa fa-star";
						document.getElementById('lol5').className="fa fa-star";
						document.getElementById('tailbar').innerHTML="Product was normal";
						rate=3;
						document.getElementById('textshit').value=rate;
					}
					lol4.onclick=function(){
						document.getElementById('lol1').className="fa fa-star checked";
						document.getElementById('lol2').className="fa fa-star checked";
						document.getElementById('lol3').className="fa fa-star checked";
						document.getElementById('lol4').className="fa fa-star checked";
						document.getElementById('lol5').className="fa fa-star";
						document.getElementById('tailbar').innerHTML="Product was good";
						rate=4;
						document.getElementById('textshit').value=rate;
					}
					lol5.onclick=function(){
						document.getElementById('lol1').className="fa fa-star checked";
						document.getElementById('lol2').className="fa fa-star checked";
						document.getElementById('lol3').className="fa fa-star checked";
						document.getElementById('lol4').className="fa fa-star checked";
						document.getElementById('lol5').className="fa fa-star checked";
						document.getElementById('tailbar').innerHTML="Product was really good";
						rate=5;
						document.getElementById('textshit').value=rate;
					}
				</script>
				{!! Form::open(array('action' => array('carcontroller@submitrate', $data['post']->id))) !!}
					<div class="form-group">
						{{Form::text('rate','',['class'=>'form-control','id'=>'textshit','placeholder'=>''])}} 
					</div>
					{{Form::submit('Submit rate',['class'=>'btn btn-primary'])}}
				{!! Form::close() !!}
				<br>	
			@endif
		@endif
	</div>
</div>
<script>document.getElementById('textshit').onload=loadfunction();
	function loadfunction(){
		document.getElementById('textshit').style.display='none';
	}
</script>
@endsection



{{-- {!! Form::open(['action'=>['carcontrollerController@submitrate',$post->id]]) !!} --}}

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

