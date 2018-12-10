@extends('layouts.default')

@section('content')
    <div class="login-to-account">
        <form method="POST" action="{{ action('MailController@sendPassword') }}">
            @csrf
            <div class="caption">
                <p>Send new password</p>
                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget laoreet est.</h3>
            </div>
            <div class="inp-wrap">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="enter your email" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                @if(isset($error))
                    <span class="invalid-feedback">
                        <strong>{{ $error }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btns submit" type="submit">
                <i></i>
                <p>Send</p>
            </button>
        </form>
    </div>
@endsection