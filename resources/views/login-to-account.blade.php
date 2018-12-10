@extends('layouts.default')

@section('content')
    <div class="login-to-account">
        <div class="button-wrap">
            <div class="registration all-button">
                <a href="create-account">Registration</a>
            </div>
            <div class="log-in all-button active">
                <a href="login-to-account">Login</a>
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="caption">
                <p>Login to Account</p>
                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget laoreet est.</h3>
            </div>
            <div class="inp-wrap">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Login" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="inp-wrap">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <button class="btn btns submit" type="submit">
                <i></i>
                <p>Login</p>
            </button>
            <a href="{{route('forgot-password')}}">Forgot Your Password?</a>
            <div class="social-wrap">
                <div class="caption">
                    <p>Login
                        <span></span>With</p>
                </div>
                <a href="{{route('auth/facebook')}}">Connect with
                    <img src="img/pics/connect-fb.png" alt="">
                </a>
                <a href="{{route('auth/vk')}}">Connect with
                    <img src="img/pics/connect-vk.png" alt="">
                </a>
                <a href="{{route('auth/google')}}">Connect with
                    <img src="img/pics/connect-g.png" alt="">
                </a>
            </div>

        </form>
    </div>
@endsection