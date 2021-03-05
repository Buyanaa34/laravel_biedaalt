@extends('layouts.apps')
<style>
       .sign_up{/*home page deer slide hiij bga ug*/
    font-size: 50px;
    animation-duration: 3.6s;
    animation-fill-mode: forwards; 
    animation-name: lol1;
    font-style: Aria;
    text-align: center;
    color: #ff6961;
}

@keyframes lol1 { 
    from {
        padding-right: 200px;
        color: #414141;
    }
    to {
        padding-left: 0px;
        color: #ff6961;
    }
}
@keyframes lol { 
    from {
        padding-left: 165px;
        opacity: 0;
    }
    to {
        padding-left: 10px;
        opacity: 1;
    }
}
.picture{
    
    animation-duration: 3.6s;
    animation-fill-mode: forwards; 
    animation-name: lol;
}
</style>
@section('content')
<div class="container">
    <div>
        <div class="col-md-8">
            <div class="card" style="width: 150%;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);">
                <div class="card-header"><h1 style="text-align: center"><strong>{{ __('Register') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div style="display: grid;grid-template-columns: repeat(2, 50%);">
                        <div class="REGISTER_PART">
                            <h2 class="sign_up" >Sign up</h2>
                            <hr>
                            <div class="form-group row" style="padding-top: 100px">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="picture">
                            <div><img src="/carental/public/storage/cover_images/signup.png" style="width: 450px;height:400px;"></div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
