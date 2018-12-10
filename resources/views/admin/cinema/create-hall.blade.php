@extends('layouts.default-admin')

@section('content')
    <div class="create-cinema">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{action('HallController@store', ['id' => $id])}}">
                    @csrf
                    <p>Create hall</p>
                    <div class="label">
                        <input id="name" type="text" name="name" placeholder="hall name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                    </div>
                    @if ($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                    @endif
                    <input class="submit" type="submit" name="submit" value="CREATE">
                </form>
            </div>
        </div>
    </div>
@endsection