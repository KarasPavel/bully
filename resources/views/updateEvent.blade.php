@extends('layouts.default')

@section('content')
    <div class="thank-you-wrap">
        <div class="thank-you">
            <img class="event-was-created" src="{{asset('img/pics/create-event.png')}}" alt="">
            <h1>Evemnt Was Created</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. </p>
            <div class="btn">
                <p>CONTINUE</p>
            </div>
        </div>
    </div>
    <!-- include components/_thank_you.pug-->
    <div class="create-event">
        <h1>Start Building Your Event:</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. </p>
        <form method="post" action="{{ action('EventController@update', ['id' => $event->id]) }}" enctype="multipart/form-data">
            @csrf
            <p>INFO</p>
            <div class="label">
                <input id="title" type="text" name="title" placeholder="event name" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $event->title}}" >
            </div>
            @if ($errors->has('title'))
                <p>{{ $errors->first('title') }}</p>
            @endif
            @if ($errors->has('title'))
                <p>{{ $errors->first('title') }}</p>
            @endif


            <div class="label half-part">
                <p>Date Start</p>
                <div class="datepicker-start" data-language='en' data-timepicker="true" ></div>
                <input type="hidden" value="{{ $event->dateStart }}" id="dateStart" name="dateStart">
                <input type="hidden" value="{{ $event->timeStart }}" id="timeStart" name="timeStart">
            </div>
            @if ($errors->has('dateStart'))
                <p>{{ $errors->first('dateStart') }}</p>
            @endif
            @if ($errors->has('timeStart'))
                <p>{{ $errors->first('timeStart') }}</p>
            @endif

            <div class="label half-part">
                <p>Date End</p>
                <div class="datepicker-end" data-language='en' data-timepicker="true" ></div>
                <input type="hidden" value="{{ $event->dateEnd }}" id="dateEnd" name="dateEnd">
                <input type="hidden" value="{{ $event->timeEnd }}" id="timeEnd" name="timeEnd">
            </div>

            @if ($errors->has('dateEnd'))
                <p>{{ $errors->first('dateEnd') }}</p>
            @endif
            @if ($errors->has('timeEnd'))
                <p>{{ $errors->first('timeEnd') }}</p>
            @endif
            <div class="label half-part">
                <p>Select category</p>
                <p>Chekin Radius</p>
                <p>Age Restrictions</p>
            </div>
            @if ($errors->has('categoryId'))
                <p>{{ $errors->first('categoryId') }}</p>
            @endif
            <div class="label half-part">
                <select id="categoryId" name="categoryId" class="form-control{{$errors->has('categoryId') ? ' is-invalid' : '' }}" required>
                    @foreach($categories as $category)
                        <option name="categoryId" value="{{$category->id}}" {{ $event->categoryId == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>

                <select name="chekinRadius" required>
                    <option value="10" {{ $event->chekinRadius == 10 ? 'selected' : '' }}>10m</option>
                    <option value="30" {{ $event->chekinRadius == 30 ? 'selected' : '' }}>30m</option>
                    <option value="50" {{ $event->chekinRadius == 50 ? 'selected' : '' }}>50m</option>
                    <option value="80" {{ $event->chekinRadius == 80 ? 'selected' : '' }}>80m</option>
                </select>

                <select name="ageRestrictions" required>
                    <option value="0+" {{ $event->ageRestrictions == '0+' ? 'selected' : '' }}>0+</option>
                    <option value="6+" {{ $event->ageRestrictions == '6+' ? 'selected' : '' }}>6+</option>
                    <option value="12+" {{ $event->ageRestrictions == '12+' ? 'selected' : '' }}>12+</option>
                    <option value="16+" {{ $event->ageRestrictions == '16+' ? 'selected' : '' }}>16+</option>
                    <option value="18+" {{ $event->ageRestrictions == '18+' ? 'selected' : '' }}>18+</option>
                </select>
            </div>
            <p class="entry">Entry</p>
            <input class="radio" type="radio" id="create-ev-free" name="entry" value="free" {{ $event->entry == 'free' ? 'checked' : '' }}>
            <label for="create-ev-free">
                <p>Free</p>
            </label>
            <input class="radio" type="radio" id="create-ev-paid" name="entry" value="paid" {{ $event->entry == 'paid' ? 'checked' : '' }}>
            <label for="create-ev-paid">
                <p>Paid</p>
            </label>
            <input class="file" type="file" name="eventImage"  id="Header_Image" >
            <label class="Header_Image" for="Header_Image">
                <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                <input type="hidden" name="oldEventImage" value="{{$event->eventImage}}">
                <p>Upload Header Image
                    <span>(size 1920x980px)</span>
                </p>
            </label>
            @if ($errors->has('eventImage'))
                <p>{{ $errors->first('eventImage') }}</p>
            @endif
            <div class="description-image">
                @if(isset($descriptionImages) && count($descriptionImages)>0)
                    @foreach($descriptionImages as $descriptionImage)
                        <input  class="file" type="file" name="descriptionImages[]" id="Content_Image{{$descriptionImage->id}}">
                        <label class="Content_Image{{$descriptionImage->id}}" for="Content_Image{{$descriptionImage->id}}" style="background:url({{asset(stristr($descriptionImage->image, 'img'))}}); background-size:100% 100%">
                            <input type="hidden" name="oldDescriptionImages[]" class="oldDescriptionImages" value="{{asset($descriptionImage->image)}}">
                            <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                            <p>Upload Content Image</p>
                        </label>
                    @endforeach
                @else
                    <input  class="file" type="file" name="descriptionImages[]" id="Content_Image" value="">
                    <label class="Content_Image" for="Content_Image">
                        <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                        <p>Upload Content Image</p>
                    </label>
                @endif
                <div class="btn for-img" id="add-more-image">
                    <p>Add More Image</p>
                </div>
            </div>
            @if ($errors->has('descriptionImages'))
                <p>{{ $errors->first('descriptionImages') }}</p>
            @endif
            <div class="description-wrap">
                <div class="description">
                    <textarea name="description" style="width:100%; height:180px; margin-top:15px" >{{ $event->description  }}</textarea>
                </div>
                <p class="description-plh" id="description-plh">Add Description</p>
            </div>
            @if ($errors->has('description'))
                <p>{{ $errors->first('description') }}</p>
            @endif
            <p>Edit Hall</p>
            <div class="label">
                <p>Select cinema</p>
                <select id="cinemaId" name="cinemaId" class="form-control{{ $errors->has('cinemaId') ? ' is-invalid' : '' }}" >
                    @foreach($cinemas as $cinema)
                        @foreach($eventCinemas as $eventCinema)
                            <option value="{{$cinema->id}}" {{ $cinema->id == $eventCinema->id ? 'selected' : '' }}>{{ $cinema->name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="label">
                <p>Select hall</p>
                <select id="hallId" name="hallId" class="form-control{{ $errors->has('hallId') ? ' is-invalid' : '' }}" >
                    @if(isset($eventHall) && !empty($eventHall))
                        <option value="{{$eventHall->id}}" {{ $eventHall->id == $eventHall->id ? 'selected' : '' }}>{{ $eventHall->name }}</option>
                    @endif
                </select>
            </div>

            <div class="label">
                @foreach($eventCinemas as $eventCinema)
                    <input id="address" type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="Location: {{$eventCinema->address}}" required>
                @endforeach
            </div>
            @if ($errors->has('address'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. </h2>
            <p class="cover">Cover</p>
            <input class="file" type="file" name="coverImage" id="Cover_Image" >
            <label class="Cover_Image" for="Cover_Image">
                <input type="hidden" name="oldCoverImage" value="{{$event->coverImage}}">
                <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                <p>Upload Cover Image</p>
            </label>
            @if ($errors->has('coverImage'))
                <p>{{ $errors->first('coverImage') }}</p>
            @endif
            <div class="change-size">
                <p>Change size</p>
                <img src="{{asset('img/pics/small-size.png')}}" alt="">
                <div class="scale"></div>
                <div class="point"></div>
                <img class="big-size" src="{{asset('img/pics/small-size.png')}}" alt=""> </div>
            <div class="title_for_cover-wrap">
                <div class="title_for_cover" contenteditable="true">
                    <input id="coverTitle" class="form-control{{ $errors->has('coverTitle') ? ' is-invalid' : '' }}" type="text" name="coverTitle" value="{{ $event->coverTitle }}" required>
                </div>
                @if ($errors->has('coverTitle'))
                    <p>{{ $errors->first('coverTitle') }}</p>
                @endif
                <p class="title_for_cover-plh" id="title_for_cover-plh">Title for cover</p>
            </div>
            <input type="hidden" name="oldHallId" value="{{$event->hallId}}">
            <div style="width: 500px; height: 85px">
                <input class="submit" type="submit" name="submit" value="EDIT">
                <a href="{{action('EventController@destroy', ['id' => $event->id])}}" onclick="return confirm('Delete an event?')"><p>delete event</p></a>
            </div>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $('#cinemaId').on('change', function () {
                $('#hallId').empty();
                $.post("{{asset('checkHall')}}", {
                        item: $('#cinemaId').val(),
                        dateStart: $('#dateStart').val(),
                        //timeStart: $('#timeStart').val(),
                        dateEnd: $('#dateEnd').val(),
                        //timeEnd: $('#timeEnd').val()
                    },
                    function (response){
                        console.log(response);
                        $('#address').val('Location: ' + response[1][0].address);
                        for (var i = 0; i < response[0].length; i++){

                            $('#hallId').append('<option value="' + response[0][i].id + '">' + response[0][i].name + '</option>');

                        }

                        $('#hallId').find('option').each(function() {

                            var $thisOption = $(this);
                            var valueToCompare = 0;
                            for(var j = 0; j < response[2][0].length; j++) {
                                valueToCompare = response[2][0][j];

                                if ($thisOption.val() == valueToCompare) {
                                    $thisOption.attr("disabled", "disabled");
                                }
                            }
                        });
                    });
            });

            var eventImage = "{{asset($event->eventImage)}}";
            var coverImage = "{{asset($event->coverImage)}}";

            var showAppEventImage = eventImage.split('public/')[1];
            var showAppCoverImage = coverImage.split('public/')[1];
            if(showAppEventImage){
                eventImage = "{{asset(stristr($event->eventImage, 'img'))}}";
            }
            if(showAppCoverImage){
                coverImage = "{{asset(stristr($event->coverImage, 'img'))}}";
            }
            $('.Header_Image').css({'backgroundImage': 'url('+ eventImage +')','background-size': '100% 100%'});
            $('.Cover_Image').css({'backgroundImage': 'url('+ coverImage +')','background-size': '100% 100%'});

            var i = 0;
            $('#add-more-image').on('click', function(){
                i++;
                $('.description-image').append('<div><input  class="file" type="file" name="descriptionImages[]" id="Content_Image'+i+'">'+
                    '<label class="Content_Image'+i+'" for="Content_Image'+i+'">'+
                    '<img src="{{asset('img/pics/alt-img.png')}}" alt="">'+
                    '<p>Upload Content Image</p>'+
                    '</label></div>');
            });

            var entry = "{{$event->entry}}";
            if(!entry){
                $('#create-ev-paid').attr("checked", "checked")
            }

        });
        $(document).click(function () {
            $('.file').on('change', function () {
                readURL(this);
                var oldImg = $('.'+this.id).find('.oldDescriptionImages');
                if (oldImg){
                    oldImg.remove();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            var eventStart = new Date("{{$event->dateStart . ' ' . $event->timeStart}}");

            var datepickerStart = $('.datepicker-start');
            var datepickerEnd = $('.datepicker-end');

            datepickerStart.datepicker().data('datepicker').selectDate(eventStart);

            datepickerStart.datepicker({
                language: 'en',
                onSelect: function (date, cellType) {
                    var dateStart = date.split(' ')[0];
                    dateStart = dateStart.split('/')[2]+'-'+dateStart.split('/')[0]+'-'+dateStart.split('/')[1];
                    var timeStart = String(cellType).split(' ')[4];
                    $('input[name="dateStart"]').val(dateStart);
                    $('input[name="timeStart"]').val(timeStart);
                }
            });

            var eventEnd = new Date("{{$event->dateEnd . ' ' . $event->timeEnd}}");

            datepickerEnd.datepicker().data('datepicker').selectDate(eventEnd);

            datepickerEnd.datepicker({
                language: 'en',
                startDate: eventEnd,
                onSelect: function (date, cellType) {
                    var dateEnd = date.split(' ')[0];
                    dateEnd = dateEnd.split('/')[2]+'-'+dateEnd.split('/')[0]+'-'+dateEnd.split('/')[1];
                    var timeEnd = String(cellType).split(' ')[4];
                    $('input[name="dateEnd"]').val(dateEnd);
                    $('input[name="timeEnd"]').val(timeEnd);
                }
            });

            $(window).on('load', function(){

                var  hiddenDateStart = $('#dateStart').val();
                var  hiddenTimeStart = $('#timeStart').val();
                var  eventStart = new Date(hiddenDateStart + ' ' + hiddenTimeStart);

                if(eventStart != 'Invalid Date'){
                    datepickerStart.datepicker().data('datepicker').selectDate(eventStart);
                }

                var  hiddenDateEnd = $('#dateEnd').val();
                var  hiddenTimeEnd = $('#timeEnd').val();
                var  eventEnd = new Date(hiddenDateEnd + ' ' + hiddenTimeEnd);

                if(eventEnd != 'Invalid Date'){
                    datepickerEnd.datepicker().data('datepicker').selectDate(eventEnd);
                }
            });
        });
    </script>
@endsection