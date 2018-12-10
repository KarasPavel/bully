@extends('layouts.default')

@section('content')
    <div class="pers-inf">
        <div class="pers-inform">
            <p>Personal Information</p>
            <a href="javascript:history.back()"></a>
        </div>

        <form method="post" action="{{ action('PersonalInformationController@update') }}" enctype="multipart/form-data">
            @csrf
            <div class="avatar">
                <input type="file" class="file" id="back" name="photo">
                <div class="back">
                </div>
                <label for="back">
                    <p>CHANGE</p>
                </label>

            </div>
            <div class="caption">
                <p>PERSONAL INFORMATION</p>
            </div>
            <div class="label">
                <input id="firstName" type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ Auth::user()->firstName}}" placeholder="first name">
                @if ($errors->has('firstName'))
                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('firstName') }}</strong>
                        </span>
                @endif

            </div>
            <div class="label">
                <input id="lastName" type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ Auth::user()->lastName }}" placeholder="last name">
                @if ($errors->has('lastName'))
                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('lastName') }}</strong>
                        </span>
                @endif
            </div>
            <div class="label">
                <input id="number" type="text" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{ Auth::user()->phone }}" placeholder="enter your number">
                @if ($errors->has('number'))
                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('number') }}</strong>
                        </span>
                @endif
            </div>
            <div class="caption change-pas">
                <p>CHANGE PASSWORD</p>
            </div>
            <div class="label">
                <input type="password" name="currentPassword" placeholder="Enter the current password(required)" value="">
                @if ($errors->has('currentPassword'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('currentPassword') }}</strong>
                    </span>
                @endif
                @if(isset($error))
                    <span class="invalid-feedback">
                        <strong>{{ $error }}</strong>
                    </span>
                @endif
            </div>
            <div class="label">
                <input type="password" name="password" id="delete-4" placeholder="Enter the password" value="">
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </div>
            <div class="label">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" placeholder="Confirm Password">
            </div>
            <button class="submit btns" type="submit" value="SAVE">
                <i></i>
                <p>SAVE</p>
            </button>
        </form>
    </div>
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.'+input.id).css({'backgroundImage': 'url('+e.target.result+')','background-size': '100% 100%'});
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function () {
            if("{{Auth::user()->photo}}"){
                $('.back').css({'backgroundImage': 'url('+"{{asset(stristr(Auth::user()->photo, 'img'))}}"+')','background-size': '100% 100%'});
            }else{
                $('.back').css({'backgroundImage': 'url("{{asset('img/pics/no-photo-doctor.gif')}}")','background-size': '100% 100%'});
            }
        });
        $(document).click(function () {
            $('.file').on('change', function () {
                readURL(this);
            });
        });
    </script>
@endsection
