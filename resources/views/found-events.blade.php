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
    </div>
    {{ $events->appends(request()->input())->links() }}
    <script type="text/javascript">
        $(document).ready(function () {
            $('.pagination').find('.page-link').each(function () {
                var oldLink = $(this).attr('href');
                if(oldLink != undefined){
                    var pageNumber = oldLink.split('search?');
                    var curentUrl = window.location.origin + window.location.pathname;
                    var newLink = curentUrl + '?' + pageNumber[1];
                    $(this).attr('href', newLink);
                }

            });
        });
    </script>
@endsection