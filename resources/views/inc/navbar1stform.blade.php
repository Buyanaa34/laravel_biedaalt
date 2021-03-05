<section id="bichleg">
  <video autoplay muted loop>
      <source  src="video/video.mp4" type="video/mp4">
  </video>
</section>

<script>
  if(document.URL.indexOf('http://localhost:82/carental/public/home')!=-1){
    let video=document.querySelector('video');
            window.addEventListener('scroll',function(){
                let value = 1+ window.scrollY/-600;
                video.style.opacity=value;
            });
  }
  else{
    document.getElementById("bichleg").style.display = "none";
  }
</script>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: rgb(62, 80, 131)">
    <a class="navbar-brand" href="/carental/public/home">caRental</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/carental/public/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/carental/public/posts/cars">rentAcar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/carental/public/posts/comments">comments</a>
        </li>
      </ul>
    </div>
  </nav>