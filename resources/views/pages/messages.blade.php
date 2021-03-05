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
	.moving_word_comment{/*comment deer slide hiij bga ug*/
    text-align: center;
    position: relative;
    font-size: 40px;
    animation-duration: 2s;
    animation-fill-mode: forwards; 
    animation-name: movewords;
    font-style: italic;
}

@keyframes movewords { 
    from {
       
        color: rgba(255, 255, 255, 0); /* transparent-aas shar ungu bolgoh heseg*/
    }
    to {
        
        color: #636363;
    }
}

.containerb {
	position: relative;
	width: 1100px;
	align-items: center;
	flex-wrap: wrap;
	justify-content: center;
	padding: 30px;
}

.containerb .cardb {
	max-width: 300px;
	position: relative;
	height: 420px;
	background: #fff;
	margin: 30px 10px;
	display: flex;
	flex-direction: column;
	box-shadow: 0 5px 20px rgba(0,0,0,0.5);
	transition: 0.3s ease-in-out;
}

.containerb .cardb:hover{
	height: 500px;
}

.containerb .cardb .imgBxb{
	position:relative;
	width: 260px;
	height: 260px;
	top: -60px;
	left: 20px;
	z-index: 0.7;
	box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.containerb .cardb .imgBxb img{
	max-width: 100%;
	border-radius: 4px;
}

.containerb .cardb .contentb{
	position:relative;
	margin-top: -140px;
	padding: 10px 15px;
	text-align: center;
	visibility: hidden;
	
	opacity: 0;
	transition: 0.3s ease-in-out;
}

.containerb .cardb:hover .contentb{
	visibility: visible;
	opacity: 1;
	margin-top: -40px;
	transition-delay: 0.3s;
}

</style>
@section('content')
<script>
	window.addEventListener('load', function () {
	document.getElementById('listz').style.opacity='1';
	});
</script>
	<div class="moving_word_comment" id="moving_word_comment" style="margin-bottom: 30px;">Messages that sent for admin</div>
    <div style="margin-bottom:120px">
        <div style="height: 10px;background:#686868"></div>
	@if(count($messages)>0)
            @foreach ($messages as $message)
            <div style="height: 10px;background:#6868688c"></div>
            <div class="row" style="background: #ff69618c;height:50px;" >
                <div class="col-md-4 col-sm-4">
                    <h3 style="text-align: right">{{$message->user['name']}}:</h3>
                </div>
                <div class="col-md-4 col-sm-4">
                    <h3 style="text-align: left">{{$message->title}}</h3>
                </div>
            </div>
            <div style="height: 10px;background:#6868688c"></div>
            @endforeach
            <div style="height: 10px;background:#686868"></div>
    </div>
		{{$messages->links()}}
    @else
        <p style="text-align: center;margin-bottom:130px">No messages found</p>
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