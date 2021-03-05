@extends('layouts.apps')
<style>
	.button {
  		border-radius: 10px;
  		background-color:#ff6961;
  		border: none;
  		color: #e2e2ff;
  		font-size: 25px;
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
		.box-areaz{
                position: absolute;
                top: 0;
                left:0;
                width: 100%;
                height: 110%;
                z-index: -1;
                overflow: hidden;
            }
            .box-areaz li{
                position: absolute;
                display: block;
                list-style: none;
                width: 25px;
                height: 25px;
                background: rgba(238, 80, 80, 0.897);
                animation: animate 20s linear infinite;
                bottom: -150px;
            }
            .box-areaz li:nth-child(1){
                left: 86%;
                width:80px;
                height: 80px;
                animation-delay: 0s;
            }
            .box-areaz li:nth-child(2){
                left: 12%;
                width:30px;
                height: 30px;
                animation-delay: 1.5s;
                animation-duration: 10s;
            }
            .box-areaz li:nth-child(3){
                left: 70%;
                width:100px;
                height: 100px;
                animation-delay: 5.5s;
            }
            .box-areaz li:nth-child(4){
                left: 70%;
                width:150px;
                height: 150px;
                animation-delay: 15s;
            }
            .box-areaz li:nth-child(5){
                left: 65%;
                width:40px;
                height: 40px;
                animation-delay: 0s;
            }
            .box-areaz li:nth-child(6){
                left: 15%;
                width:110px;
                height: 110px;
                animation-delay: 3.5s;
            }
            @keyframes animate{
                0%{
                    transform: translateY(0) rotate(0deg);
                    opacity:1;
                }
                100%{
                    transform: translateY(-800px) rotate(360deg);
                    opacity: 0;
                }
            }
</style>
@section('content')
    <script>
        window.addEventListener('load', function () {
            var label = document.getElementById("stylish_label3");
            label.style.width="70%"; //ngu stylish label-aa hudulguh heseg
            document.getElementById('listz').style.opacity='1'; //post-uudiig zuulnuur visible bolgoh heseg
        });
    </script>
    <h1 style="text-align: center">Cars that we offer for you</h1>
    <hr id="stylish_label3" style="height:5px;border:none;background-color:#ff6961;width:0%;transition: 3s;">
	@if(count($posts)>0)
	<br>
	<div class="grid_Shit">
		@foreach ($posts as $post)
		<script>var dawtalt={!!$post->rate!!};</script>
					<div class="containerm">
						<div class="cardm">
							<div class="boxm" id="boxmz">
								<div class="contentm">
									<h3>{{$post->car_name}}</h3>
									<img  style="width:150px;" src="/carental/public/storage/car_image/{{$post->car_image}}">
									<br>
									<small>Written on {{$post->created_at}}</small>
									<h3>Rating</h3>
									<script>
										//star haruulah heseg
										var i=1;
										for(i;i<=dawtalt;i++){
											var url = '<span class="fa fa-star checked"></span>';
											document.write(url);
										}
										var i1=1;
										for(i1;i1<=5-dawtalt;i1++){
											document.write('<span class="fa fa-star"></span>');
										}
										//star haruulah heseg
									</script>
									<br>
									<a href="/carental/public/car_posts/{{$post->id}}">Read more</a>
								</div>
							</div>
						</div>
					</div>
            @endforeach 
	</div>
	{{$posts->links()}}
    @else
        <p>No car posts found</p>
    @endif
	@if(!Auth::guest())
		@if(Auth::id()=='30'||Auth::user()->isadmined=='1')
		<div style="text-align: center;">
			<h3>Add a car post</h3>
			<button onclick="location.href='/carental/public/car_posts/create'" class="button"><span>Add</span></button>
		</div>
		@endif
	@endif
	<div class="box-areaz">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</div>
@endsection