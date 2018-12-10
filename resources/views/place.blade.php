@extends('layouts.default')

@section('content')

    <div class="place-info">
        <h2>{{$cinema->name}}</h2>
        @if(isset($cinema->image) && !empty($cinema->image))
            @if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false))
                <img src="{{$cinema->image}}" alt="">

            @else
                <img src="{{asset(stristr($cinema->image, 'img'))}}" alt="">
            @endif
        @else
            <img src="{{asset('img/pics/iayjjZok.jpg')}}" alt="">
        @endif
        <p class="cinema-address">Address: {{$cinema->address}}</p>
        <p class="cinema-desc">{{$cinema->description}}</p>
    </div>

@endsection