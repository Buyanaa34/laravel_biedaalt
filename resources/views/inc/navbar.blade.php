<div id="bichleg">
    <video autoplay muted loop>
        <source  src="video/video.mp4" type="video/mp4">{{-- mashintai video --}}
    </video>
</div>

<div class="moving_word" id="moving_word">
  Welcome to our website !
</div>

<div class="navigation_class">
  <script>
    if(document.URL.indexOf('http://localhost:82/carental/public/home')!=-1){//herwee home page mun bol videog haruulna
      document.getElementById('content1').classList.add('content1'); //home page mun bol contentiin min height-iig ihesgene
      let video=document.querySelector('video');
      let navbar=document.querySelector('nav');
              window.addEventListener('scroll',function(){
                  let value = 1+ window.scrollY/-600;
                  video.style.opacity=value;
              });
    }
    else{//herew home page bish bol videog haruulku
      document.getElementById("bichleg").style.display = "none"; 
      document.getElementById("moving_word").style.display = "none";//moving word-g home page-ees busad page-d haruulahgui
      document.getElementById('content1').classList.add('content1nothome');//home page bish bol contentiin min height-iig bagasgana
    }
    window.onscroll = function() {scrollFunction1()}; // scrolldoh ued navbar-iin hemjee ungu uurchlugduh heseg
              function scrollFunction1() {
                if (document.body.scrollTop > 120 || document.documentElement.scrollTop > 120) {
                  document.getElementById("navbar").style.height = "60px";
                  document.getElementById("navbar").style.backgroundColor="#575757d3";
                } else {
                  document.getElementById("navbar").style.height = "80px";
                  document.getElementById("navbar").style.backgroundColor="#57575781";
                }
                //**********************BODY-HESEGIN label-iin effect***********************//
                //ygd navbar-t body hiisn be gewel neg html/php etc dotor 1+ scroll listener bhar fkd up blod bsn//
                var div2 = document.getElementById("stylish_label2");
                var div1 = document.getElementById("stylish_label1");
                var rect1 = div1.getBoundingClientRect();
                var rect2 = div2.getBoundingClientRect();
                
                if (rect2.top<645) {
                div2.style.width = "70%";
                }
                if (rect1.top<645) {
                  div1.style.width = "70%";
                }
                
                //***********************zurag-fade-in hiih heseg************************/
                var picshit = document.getElementById("flexboxz");
                var picloc = picshit.getBoundingClientRect();
                if(picloc.top<645){
                  picshit.style.opacity=1;
                }
    }
  </script>
  <span>
    <nav id="navbar" class="navbar navbar-expand-md navbar-dark" style="background-color: #57575781" >
        <a class="navbar-brand" href="/carental/public/home">caRental</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" id="nav-link" href="javascript:findhref()">Home</a>
              <script>
                function findhref(){
                  if(document.URL.indexOf('http://localhost:82/carental/public/home')!=-1 || document.URL.indexOf('http://localhost:82/carental/public/home#about')!=-1|| document.URL.indexOf('http://localhost:82/carental/public/home#deed_tal')!=-1){
                  //document.getElementById('nav-link').href="#deed_tal";
                  $("#nav-link").attr("href", "#deed_tal");
                }
                else{
                  //document.getElementById('nav-link').href="/carental/public/home";
                  $("#nav-link").attr("href", "/carental/public/home");
                }
              }
              </script>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-link" href="/carental/public/car_posts">rentAcar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-link" href="/carental/public/posts">comments</a>
            </li>
              <li class="nav-item" id="nav-item">
                <a class="nav-link" id="nav-link1" href="javascript:abouthref()">About us</a>
                <script>
                  function abouthref(){
                  if(document.URL.indexOf('http://localhost:82/carental/public/home')!=-1 || document.URL.indexOf('http://localhost:82/carental/public/home#about')!=-1|| document.URL.indexOf('http://localhost:82/carental/public/home#deed_tal')!=-1){
                  //document.getElementById('nav-link').href="#about";
                  $("#nav-link1").attr("href", "#about");
                  }
                  else{
                  //document.getElementById('nav-link').href="/carental/public/home#about";
                  $("#nav-link1").attr("href", "/carental/public/home#about");
                  }
                  }
                </script>
              </li>
          </ul>


          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
              @if (Auth::user()->id!='30')
                  @if(Auth::user()->isadmined=='0')
                      <li class="nav-item" >
                      <img  class="nav-link" id="basket_icon" onclick="location.href='/carental/public/rent'" style="margin-top:10px;height: 40px;width:40px;" src="/carental/public/storage/cover_images/icon.png"> 
                      </li>
                      <li style="margin-top: 5px;font-size:30px;padding-right:13px;padding-left:0px">
                          <div style="color: #ff6961 "  class="badge">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</div>
                      </li>
                  @endif
              @else
              <li class="nav-item" style="margin-top: 14px;margin-right:20px" >
                <a href="{{route('showmessage')}}" style="color: #ff6961"><i style="font-size: 32px" class="fa fa-telegram"></i></a>
                </li> 
              @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a href="/carental/public/dashboard" class="dropdown-item">Dashboard</a>
                      <a href="/carental/public/profile" class="dropdown-item">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        </div>
      </nav>
  </span> 
</div>





















{{-- <script>
  window.onscroll = function() {myFunction()};
  
  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  
  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }
</script> --}}




{{--var id = setInterval(hieghtchanger,5);
                  function hieghtchanger(){
                    if(window.scrollY==500){
                    if(oldscroll>window.scrollY){//dooshilj bn
                      if(height==60){
                        clearInterval(id);
                      }
                      else{
                        height-=4;
                        document.getElementById('navbar').style.height=height.toString();
                      }
                    }
                    else{//deeshilj bn
                      if(height==80){
                        clearInterval(id);
                      }
                      else{
                        height+=4;
                        document.getElementById('navbar').style.height=height.toString()+"px";
                      }
                    }
                  }
                  else{
                    clearInterval(id);
                  }
                  oldscroll=window.scrollY;
                  } --}}





{{-- <script>
    document.querySelectorAll('a[href^="#about"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
  </script> --}}
  