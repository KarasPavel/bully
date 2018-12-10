@extends('layouts.default-admin')

@section('content')
    <a href="{{route('admin/cinema-management/create-cinema')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add cinema</a>
    <div class="wrapper-cinema" id="wrapper-stick">
        <div class="cinema-w" id="stick-w">
            @foreach($cinemas as $cinema )
                <div class=".container-fluid">
                    <a class="cinema-item" href="cinema-management/cinema/{{$cinema->id}}">
                        <div class="cinema">
                            <div class="cinema-img">
                                <div class="stick-type">
                                </div>
                                @if(isset($cinema->image) && !empty($cinema->image))
                                    @if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false))
                                        <img src="{{$cinema->image}}" alt="">
                                    @else
                                        <img src="{{asset(stristr($cinema->image, 'img'))}}" alt="">
                                    @endif
                                @else
                                    <img src="{{asset('img/pics/iayjjZok.jpg')}}" alt="">
                                @endif
                            </div>
                            <div class="cinema-name">
                                <p>{{$cinema->name}}</p>
                                <h4>{{$cinema->address}}</h4>
                            </div>
                        </div>
                    </a>
                    <a href="cinema-management/edit-cinema/{{$cinema->id}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">EDIT</a>
                </div>
            @endforeach
            {{$cinemas->render()}}
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(e) {
            $('.pagination').find('.page-link').each(function () {
                var oldLink = $(this).attr('href');
                if(oldLink != undefined){
                    var pageNumber = oldLink.split('=');
                    var curentUrl = window.location.origin + window.location.pathname;
                    var newLink = curentUrl + '?page=' + pageNumber[1];
                    $(this).attr('href', newLink);
                }

            });
        });
    </script>
@endsection
