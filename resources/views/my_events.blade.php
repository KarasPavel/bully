@extends('layouts.default')

@section('content')
        <div class="my-events-wrap">
            <div class="my-events">
                <div class="caption">
                    <p>My Events</p>
                    <a href="javascript:history.back()"></a>
                </div>
                <div class="button-wrap">
                    <div class="button-bar">
                        <div class="button all">
                            <p class="active">ALL</p>
                        </div>
                        <div class="button past">
                            <p>Past</p>
                        </div>
                        <div class="button current">
                            <p>CURRENT</p>
                        </div>
                    </div>
                   <!-- <div class="button-draft">
                        <p>draft (10)</p>
                    </div>-->
                </div>
                <div class="events">
                    @foreach($myEvents as $event)
                        <form method="post" action="{{ action('MyEventsController@update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="newEventImage" id="image" >
                            <div class="Cover_Image" for="image">
                                <img src="{{ stristr($event->coverImage, 'img')}}"  alt="">
                                <p>{{$event->title}}</p>
                                <a href="update-event/{{$event->id}}">
                                    <p>EDIT</p>
                                </a>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    <script type="text/javascript">
        function filtr(div) {
            var text = $(div).find('p').text();
            $.post("{{asset('event-filter')}}", {time: text}, function (response) {
                if(response){
                    $('.events').empty();
                    for (var i = 0; i <= response.length; i++){
                        if (typeof response[i] == 'object') {
                            $('.events').append(
                                '<form method="post" action="{{ action('MyEventsController@update') }}" enctype="multipart/form-data">' +
                                '@csrf' +
                                '<input type="file" name="newEventImage" id="image" >' +
                                '<div class="Cover_Image" for="image">' +
                                '<img src="' + response[i].coverImage.split('public/')[1] + '"  alt="">' +
                                '<p>' + response[i].title + '</p>' +
                                '<a href="update-event/' + response[i].id + '">' +
                                '<p>EDIT</p>' +
                                '</a>' +
                                '</div>' +
                                '</form>'
                            );
                        }
                    }
                }
            });
        }
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.button').on('click', function () {
                filtr(this);
            });
        });
    </script>
@endsection
