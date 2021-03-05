@extends('layouts.apps')
@section('content')
<div class="gol-heseg">
    <script>
        /*
        window.onscroll = function() {scrollFunction()}; // scrolldoh ued navbar-iin hemjee ungu uurchlugduh heseg
        function scrollFunction() {
            var div2 = document.getElementById("stylish_label2");
            var div1 = document.getElementById("stylish_label1");
            var rect1 = div1.getBoundingClientRect();
            var rect2 = div2.getBoundingClientRect();
            if (rect2.top<645) {
                var a = document.getElementById("stylish_label2");
                a.style.width = "70%";
            }
            if (rect1.top<645) {
                var a = document.getElementById("stylish_label1");
                a.style.width = "70%";
            }
            }*/
    </script> 
    <div >
        <h1 id="marketing" style="text-transform: uppercase">Rent an any car that u want from our site !</h1>
    </div>
    <script>
        var textlabel =document.getElementById('marketing'); //marketing--g awj bn
        //850 //315 //535 //625 
        /* Text-iig scrolld taaruulj hudulguh code version 0.1
        window.addEventListener('scroll',function(){
                document.getElementById('meh').innerHTML=window.scrollY;
                if(window.scrollY>334){
                    textlabel.style.paddingLeft=(625-(window.scrollY-234))  .toString()+"px";
                    let value = -1+ window.scrollY/600;
                    textlabel.style.opacity=value;
                }
            });*/
            var oldscroll=0;
           // var word_location=625;
            window.addEventListener('scroll',function(){
                let value = -1+ window.scrollY/300;
                textlabel.style.opacity=value;
                //Text-iig scrolld taaruulj hudulguh code version 0.2
                /*if(oldscroll>window.scrollY){
                    if(word_location<626){
                        word_location+=10;
                        textlabel.style.paddingLeft=word_location.toString();
                    }
                }
                else{
                    if(word_location>=0){
                    word_location-=10;
                    textlabel.style.paddingLeft=word_location.toString();
                    }
                }
                oldscroll=window.scrollY;*/
            });
    </script>
    <br>
    <h2 style="font-size: 40px" >ABOUT US</h2>
    <hr id="stylish_label1" style="height:5px;border:none;background-color:#ff6961;width:0%;transition: 3s;"> {{-- visual studio-oor bol label ymuda --}}
    <br>
    <br>
        <div style="font-size: 27px">We are the company that can give u the cars that u cannot afford. We have many types of cars. And we have started our company since 2000 till now 
            and during those years, our costumers always recommend our company to their friends and relatives and other people. So hope u enjoy to rent our cars 
        </div>
        <br>
        <h1 id="about">Some of our members</h1>
        <hr  id="stylish_label2" style="height:5px;border:none;background-color:#ff6961;width:0%;transition: 3s;">
        <section class="sectiono">
            <div class="containero">
                {{-- crew_1 --}}
                <div class="cardo">
                    <div class="contento">
                        <div class="imgbxo"><img src="/carental/public/storage/cover_images/crew.jpg"></div>
                        <div class="contentbxo">
                            <h3><strong>George Ervin</strong> </h3><span><Strong>Programmer</Strong> </span>
                        </div>
                    </div> 
                    <ul class="scio">
                        <li style="--i:1;">
                            <a href="#"><i style="font-size: 36px" class="fa fa-facebook"></i></a>
                        </li>
                        <li style="--i:2;">
                            <a href="#"><i style="font-size: 36px" class="fa fa-instagram"></i></a>
                        </li>
                        <li style="--i:3;">
                            <a href="#"><i style="font-size: 36px" class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
                {{-- crew_2 --}}
                <div class="cardo">
                    <div class="contento">
                        <div class="imgbxo"><img src="/carental/public/storage/cover_images/crew2.jpg"></div>
                        <div class="contentbxo">
                            <h3><strong>James Johnson</strong></h3><span><Strong>Supervisor</Strong></span>
                        </div>
                    </div> 
                    <ul class="scio">
                        <li style="--i:1;">
                            <a href="#"><i style="font-size: 36px" class="fa fa-facebook"></i></a>
                        </li>
                        <li style="--i:2;">
                            <a href="#"><i style="font-size: 36px" class="fa fa-instagram"></i></a>
                        </li>
                        <li style="--i:3;">
                            <a href="#"><i style="font-size: 36px" class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
                {{-- crew_3 --}}
                <div class="cardo">
                    <div class="contento">
                        <div class="imgbxo"><img src="/carental/public/storage/cover_images/crew3.jpg"></div>
                        <div class="contentbxo">
                            <h3><strong> David Davidson</strong></h3><span><Strong>Advertising agent</Strong></span>
                        </div>
                    </div> 
                    <ul class="scio">
                        <li style="--i:1">
                            <a href="#"><i style="font-size: 36px" class="fa fa-facebook"></i></a>
                        </li>
                        <li style="--i:2">
                            <a href="#"><i style="font-size: 36px" class="fa fa-instagram"></i></a>
                        </li>
                        <li style="--i:3">
                            <a href="#"><i style="font-size: 36px" class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
</div>
@endsection












<script>
/*function movetext(){
    var textlabel =document.getElementById('marketing'); //marketing--g awj bn
    var location = window.getComputedStyle(textlabel, null).getPropertyValue('padding-left');// marketing-iin left padding-iin utgiig awj bn
    location = parseInt(location);
    //textlabel.style.paddingLeft=location.toString()+"px";
   // while(location>0){
        //textlabel.innerHTML=location;
        //location-=5;
        //textlabel.style.paddingLeft=location.toString()+"px";
        //textlabel.style.opacity+=0.008;
   // } 
}*/
</script>
