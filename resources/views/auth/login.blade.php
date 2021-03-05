@extends('layouts.apps')
<style>
   .sign_up{/*home page deer slide hiij bga ug*/
    font-size: 50px;
    animation-duration: 3.6s;
    animation-fill-mode: forwards; 
    animation-name: lol;
    font-style: italic;
    text-align: center;
    color: #ff6961;
}

@keyframes lol { 
    from {
        padding-right: 200px;
        opacity: 0;
    }
    to {
        padding-right: 0px;
        opacity: 1;
    }
}
.loginpic{
    animation-duration: 3.6s;
    animation-fill-mode: forwards; 
    animation-name: lol;
}
</style>
@section('content')
<div class="container" style="margin-bottom:15px">
    <div>
        <div class="col-md-8">
            <div class="card" style="width: 150%;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);">
                <div class="card-header" style="background: #ffffff"><h1 style="text-align: center"><strong>Welcome back</strong></h1></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        
                        <br>
                        @csrf
                        <div style="display: grid;grid-template-columns: repeat(2, 50%);">
                            <div class="loginpic">
                                <img src="/carental/public/storage/cover_images/login1.png" style="width: 500px;height:500px;padding-bottom:50px">
                            </div>
                            <div class="sda" >
                                <h2 class="sign_up" >Sign in</h2>
                                <hr>
                                <div class="form-group row" style="padding-top:100px">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
        
                                        {{-- @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
