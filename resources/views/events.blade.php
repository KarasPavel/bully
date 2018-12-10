@extends('layouts.default')

@section('content')
<div class="all-events">
@foreach($events as $event)
    <div class="card event event-grid">
        <header class="card__thumb">
            @if(isset($event->eventImage) && !empty($event->eventImage))
                @if(strpos($event->eventImage, 'https://') !== false)
                    <img src="{{$event->eventImage}}">
                @else
                    <img src="{{asset( stristr($event->eventImage, 'img'))}}" alt="">
                @endif
            @endif
        </header>
        <div class="card__body">
            <a href="event/{{$event->id}}">MOVIE</a>
            <h2 class="card__subtitle">{{$event->title}}</h2>
            <p>{!! html_entity_decode($event->description)!!}</p>
        </div>
    </div>
@endforeach
{{$events->render()}}
</div>

@endsection
