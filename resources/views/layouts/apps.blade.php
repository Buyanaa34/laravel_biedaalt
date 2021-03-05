<!DOCTYPE html>
<html>
    <head>
        <style>
            
            
    
        </style>
        <div id="deed_tal"></div> {{-- one page anchord ashiglahiin tuld nemsen div --}}
        {{-- Navbar --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/app.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        {{-- Navbar --}}
        <link rel="stylesheet" href="{{asset('css/loader.css')}}">      
    </head>
<body>
    <div class="animation-area">
        {{--startloader--}}
        <div class="loader-wrapper" id="loader-wrapper" style="overflow:hidden" >
            <span id="loader" class="loader" >
                <span class="loader-inner"></span>
            </span>
        </div>

        {{--endloader--}}

        <section class="content1" id="content1">
            @include('inc.navbar') 
        </section>
        <section class="content2">
                @include('inc.messages')
                @yield('content')
        </section>
        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
        {{--startloader--}}
        <script>
            $(window).on('load', function(){
                $('#loader-wrapper').fadeOut();
            });
        </script>
        {{--endloader--}}

        @yield('scripts')
        
    </div>
    
</body>
<footer style="height: 37%;background:rgba(102, 102, 102, 0.589);" >
    <div style="display: grid; display: grid;grid-template-columns: repeat(2, 50%);justify-content: center;align-items: center;">
        <div style="padding-left:40px;padding-top:10px;color: white;text-align:left;padding-bottom:10px">
            <h1 style="padding-top: 20px">Get in Touch !</h1>
            <h2 style="padding-top: 35px"><img src="/carental/public/storage/cover_images/iconmap.png" style="width: 5%"> -Mongolia, Orkhon, Bayan-Undur</h2>
            <h2  style="padding-top: 20px"><img src="/carental/public/storage/cover_images/mail.png" style="width: 5%">-MailName@gmail.com</h2>
        </div>
        <div style="padding-left:40px;padding-top:10px;color: white;text-align:left;">
            <div>
                <h1 style="padding-top: 20px">caRental's social address</h1>
                <span style="font-size:23px">Facebook:<a href="https://www.facebook.com/Buyanovic/" target="_blank" style="color: #ff6961"><i style="font-size: 36px" class="fa fa-facebook"></i></a></span> <br>
                <span style="font-size:23px">Instagram:<a href="https://www.instagram.com/buyanovic/" target="_blank" style="color: #ff6961"><i style="font-size: 36px" class="fa fa-instagram"></i></a></span> <br>
                <span style="font-size:23px">Twitter:<a href="https://twitter.com/Buyaa17" target="_blank" style="color: #ff6961"><i style="font-size: 36px" class="fa fa-twitter"></i></a></span>
            </div>
        </div>
    </div>
</footer>
</html> 
















{{-- <script>
        var isloaded = false;
        /*while(document.readyState!='complete'){
            if(document.URL.indexOf('http://localhost:82/carental/public/loading')==-1){
                window.location.replace("/carental/public/loading");
            }   
        }*/
        while(!isloaded){
            if(document.URL.indexOf('http://localhost:82/carental/public/loading')==-1){
                if(document.readyState!='complete'){
                window.location.replace("/carental/public/loading");
                console.log('buuz');
                }
            }
            else{
                window.location.replace('/carental/public/home');
                isloaded=true;
            }
        }
        
        
        //window.location.replace('/carental/public/home');
       // $(window).on("load",function(){
         //$(".loader-wrapper").fadeOut("slow");
          //window.location.replace("loader.php");
       // });
    </script> --}}