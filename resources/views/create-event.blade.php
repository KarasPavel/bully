@extends('layouts.default')

@section('content')
    <div class="thank-you-wrap">
        <div class="thank-you">
            <img class="event-was-created" src="img/pics/create-event.png" alt="">
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <form method="post" action="{{ action('EventController@store') }}" enctype="multipart/form-data" id="create-event-form">
            @csrf
            <p>INFO</p>

            <div class="label">
                @if ($errors->has('title'))
                    <p class="date-required">{{ $errors->first('title') }}</p>
                @endif
                <input id="title" type="text" name="title" placeholder="event name" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
            </div>

            <div class="label half-part">
                <p>Date Start</p>
                @if ($errors->has('dateStart'))
                    <p class="date-required">{{ $errors->first('dateStart') }}</p>
                @endif
                <div class="datepicker-start" data-language='en' data-timepicker="true" ></div>
                <input type="hidden" value="{{ old('dateStart') }}" id="dateStart" name="dateStart" >
                <input type="hidden" value="{{ old('timeStart') }}" id="timeStart" name="timeStart" >
                @if ($errors->has('timeStart'))
                    <p class="date-required">{{ $errors->first('timeStart') }}</p>
                @endif
            </div>

            <div class="label half-part">
                <p>Date End</p>
                @if ($errors->has('dateEnd'))
                    <p class="date-required">{{ $errors->first('dateEnd') }}</p>
                @endif
                <div class="datepicker-end" data-language='en' data-timepicker="true" ></div>
                <input type="hidden" id="dateEnd" value="{{ old('dateEnd') }}" name="dateEnd">
                <input type="hidden" id="timeEnd" value="{{ old('timeEnd') }}" name="timeEnd">
                @if ($errors->has('timeEnd'))
                    <p class="date-required">{{ $errors->first('timeEnd') }}</p>
                @endif
            </div>

            <div class="label half-part">
                <p>Select category</p>
                <p>Chekin Radius</p>
                <p>Age Restrictions</p>
            </div>
            @if ($errors->has('categoryId'))
                <p class="date-required">{{ $errors->first('categoryId') }}</p>
            @endif
            <div class="label half-part">
                <select id="categoryId" name="categoryId" class="form-control{{$errors->has('categoryId') ? ' is-invalid' : '' }}" required>
                    @foreach($categories as $category)
                        <option name="categoryId" value="{{$category->id}}" {{ old('categoryId') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>

                <select name="chekinRadius">
                    <option value="10" {{ old('chekinRadius') == 10 ? 'selected' : '' }}>10m</option>
                    <option value="30" {{ old('chekinRadius') == 30 ? 'selected' : '' }}>30m</option>
                    <option value="50" {{ old('chekinRadius') == 50 ? 'selected' : '' }}>50m</option>
                    <option value="80" {{ old('chekinRadius') == 80 ? 'selected' : '' }}>80m</option>
                </select>

                <select name="ageRestrictions">
                    <option value="0+" {{ old('ageRestrictions') == '0+' ? 'selected' : '' }}>0+</option>
                    <option value="6+" {{ old('ageRestrictions') == '6+' ? 'selected' : '' }}>6+</option>
                    <option value="12+" {{ old('ageRestrictions') == '12+' ? 'selected' : '' }}>12+</option>
                    <option value="16+" {{ old('ageRestrictions') == '16+' ? 'selected' : '' }}>16+</option>
                    <option value="18+" {{ old('ageRestrictions') == '18+' ? 'selected' : '' }}>18+</option>
                </select>
            </div>

            <p class="entry">Entry</p>
            <input class="radio" type="radio" id="create-ev-free" name="entry" value="free" {{ old('entry') == 'free' ? 'checked' : '' }} required>
            <label for="create-ev-free">
                <p>Free</p>
            </label>
            <input class="radio" type="radio" id="create-ev-paid" name="entry" value="paid" {{ old('entry') == 'paid' ? 'checked' : '' }} checked required>
            <label for="create-ev-paid">
                <p>Paid</p>
            </label>

            @if ($errors->has('eventImage'))
                <p class="date-required">{{ $errors->first('eventImage') }}</p>
            @endif
            <input class="file" type="file" name="eventImage"  id="Header_Image">
            <input type="hidden" id="eventImage" name="eventImg" value="{{ old('eventImg') }}">
            <input type="hidden" name="Header_Image" value="{{ old('Header_Image') }}">
            <label class="Header_Image" for="Header_Image">
                <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                <p>Upload Header Image
                    <span>(size 1920x980px)</span>
                </p>
            </label>

            @if ($errors->has('descriptionImages'))
                <p class="date-required">{{ $errors->first('descriptionImages') }}</p>
            @endif
            <div class="description-image">
                <div>
                    <input class="file" type="file" name="descriptionImages[]" id="Content_Image">
                    <input type="hidden" id="descriptionImages" name="descriptImages[]" value="{{ old('descriptImages[]') }}">
                    <input type="hidden" name="Content_Image" value="{{ old('Content_Image') }}">
                    <label class="Content_Image" for="Content_Image">
                        <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                        <p>Upload Content Image</p>
                    </label>
                    <div class="btn for-img" id="add-more-image">
                        <p>Add More Image</p>
                    </div>
                </div>
            </div>

            @if ($errors->has('description'))
                <p class="date-required">{{ $errors->first('description') }}</p>
            @endif
            <div class="description-wrap">
                <div class="description">
                    <textarea name="description" style="resize:none; width:100%; height:180px; margin-top:15px; outline: none; border:none;">{{ old('description')  }}
                    </textarea>
                </div>
                <p class="description-plh" id="description-plh">Add Description</p>
            </div>
            <p>Select Hall</p>
            <div class="label half-part">
                <p>Select</p>
                <p>Select hall</p>
            </div>
            <div class="label half-part">
                @if ($errors->has('cinema'))
                    <p class="date-required">{{ $errors->first('cinema') }}</p>
                @endif
                <select id="cinemaId" name="cinema" class="form-control{{ $errors->has('cinema') ? ' is-invalid' : '' }}">
                    <option value="" disabled selected hidden>Cinema</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{$cinema->id}}" {{ old('cinema') == $cinema->id ? 'selected' : '' }}>{{ $cinema->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('hall'))
                    <p class="date-required">{{ $errors->first('hall') }}</p>
                @endif
                <select id="hallId" name="hall" class="form-control{{$errors->has('hall') ? ' is-invalid' : '' }}">
                </select>
                <input type="hidden" name="hallId" value="{{old('hallId')}}">

            </div>
            @if ($errors->has('address'))
                <p class="date-required">{{ $errors->first('address') }}</p>
            @endif
            <div class="label">
                <input id="address" type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Enter the exact address of the event" value="{{old('address')}}">
            </div>
            @if ($errors->has('price'))
                <p class="date-required">{{ $errors->first('price') }}</p>
            @endif
            <div class="label">
                <input id="price" type="text" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter ticket price" value="{{old('price')}}">
            </div>
            @if ($errors->has('place'))
                <p class="date-required">{{ $errors->first('place') }}</p>
            @endif
            <div class="label">
                <input id="place" type="text" name="place" class="form-control{{ $errors->has('place') ? ' is-invalid' : '' }}" placeholder="Enter the number of seats for the event" value="{{old('place')}}">
            </div>
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. </h2>
            <p class="cover">Cover</p>
            @if ($errors->has('coverImage'))
                <p class="date-required">{{ $errors->first('coverImage') }}</p>
            @endif
            <input class="file" type="file" name="coverImage" id="Cover_Image" value="">
            <input type="hidden" id="coverImage" name="coverImg" value="{{ old('coverImg') }}">
            <input type="hidden" name="Cover_Image" value="{{ old('Cover_Image') }}">
            <label class="Cover_Image" for="Cover_Image">
                <img src="{{asset('img/pics/alt-img.png')}}" alt="">
                <p>Upload Cover Image</p>
            </label>

            <div class="change-size">
                <p>Change size</p>
                <img src="img/pics/small-size.png" alt="">
                <div class="scale"></div>
                <div class="point"></div>
                <img class="big-size" src="img/pics/small-size.png" alt="">
            </div>

            @if ($errors->has('coverTitle'))
                <p class="date-required">{{ $errors->first('coverTitle') }}</p>
            @endif
            <div class="title_for_cover-wrap">
                <div class="title_for_cover">
                    <input id="coverTitle" class="form-control{{ $errors->has('coverTitle') ? ' is-invalid' : '' }}" type="text" name="coverTitle" value="{{ old('coverTitle') }}" required>
                </div>
                <p class="title_for_cover-plh" id="title_for_cover-plh">Title for cover</p>
            </div>

            <input class="submit" type="submit" name="submit" value="CREATE">
        </form>
    </div>

    <script type="text/javascript">

        function sendCinema() {

            $.post("{{asset('/checkHall')}}", {
                    item: $('#cinemaId').val(),
                    dateStart: $('#dateStart').val(),
                    //timeStart: $('#timeStart').val(),
                    dateEnd: $('#dateEnd').val(),
                    //timeEnd: $('#timeEnd').val()
                },
                function (response){

                    $('#hallId').append('<option value="" disabled selected hidden>Hall</option>');
                    for (var i = 0; i < response[0].length; i++){
                        $('#address').val("Location: " + response[1][0].address);
                        $('#hallId').append('<option value="' + response[0][i].id + '">' + response[0][i].name + '</option>');
                    }

                    $('#hallId').find('option').each(function() {

                        var $thisOption = $(this);
                        var valueToCompare = 0;
                        var oldHall = $('input[name="hallId"]').val();
                        var oldText = $thisOption.text();

                        for(var j = 0; j < response[2][0].length; j++) {
                            valueToCompare = response[2][0][j];


                            if ($thisOption.val() == valueToCompare) {
                                $thisOption.attr("disabled", "disabled").text(oldText + ' ');
                            }
                        }
                        if($thisOption.val() == oldHall){
                            $thisOption.attr('selected', 'selected');
                        }
                    });
                });
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var inputHidden = $('input[name="' + input.id + '"]');
                    inputHidden.val(e.target.result);
                    $('.'+input.id).css({'backgroundImage': 'url('+e.target.result+')','background-size': '100% 100%'});
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#cinemaId').on('change', function () {
                $('#hallId').empty();
                sendCinema();
            });
            var i = 0;
            $('#add-more-image').on('click', function(){
                i++;
                $('.description-image').append('<div><input  class="file" type="file" name="descriptionImages[]" id="Content_Image' + i + '">' +
                    "<input type=\"hidden\" id=\"descriptionImages[]\" name=\"descriptImages[]\" value={{ old('descriptImages[]') }}"+'>'+
                    '<label class="Content_Image'+i+'" for="Content_Image'+i+'">'+
                    '<img src="{{asset('img/pics/alt-img.png')}}" alt="">'+
                    '<p>Upload Content Image</p>'+
                    '</label></div>');
                //$('.Content_Image' + i).copyCSS('.create-event form input.file + label.Content_Image');
                $('.Content_Image' + i).css({'width': '54%', 'height': '327px', 'padding-top': '117px', 'display': 'inline-block',});
            });

            $('#hallId').on('change', function () {
                var selectedOption = $(this).find('option:selected');
                $('input[name="hallId"]').val(selectedOption.val());

                $.post("{{asset('select-sector')}}", {hallId: $('#hallId').find('option:selected').val()}, function (response) {
                    //console.log(response);
                })
            });

        });
        $(document).click(function () {
            $('.file').on('change', function () {
                readURL(this);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {



            var datepickerStart = $('.datepicker-start');
            var datepickerEnd = $('.datepicker-end');


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

            datepickerEnd.datepicker({
                language: 'en',
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

                $(document).find('input[type="file"]').each(function () {
                    var input = $(this);
                    var inputHidden = $('input[name="' + input[0].id + '"]');
                    var hiddenVal = inputHidden.val();

                    if(hiddenVal){
                        $('#' + input[0].name.split('[')[0]).val(hiddenVal);
                        $('.'+input[0].id).css({'backgroundImage': 'url('+hiddenVal+')','background-size': '100% 100%'});
                    }
                });

                if($('#cinemaId').val()){
                    sendCinema();

                }

                $(document).find('.date-required').each(function () {
                    $('html, body').animate({
                        scrollTop: $(this).offset().top-200
                    }, 1000);
                    return false;
                });
            });
             /*$('.submit').click(function () {
                var cinema = $('#cinemaId').val();
                var hall = $('#hallId').val();
                var place = $('#place').val();
                var price = $('#price').val();

                if(cinema && hall && place && price){
                    alert('');
                    return false;
                }
             });*/
        });
    </script>
    <script src="{{asset('js/jquery.validate.min.js')}}" ></script>
    <script type="text/javascript">

        $("#create-event-form").validate({
            rules: {
                title: {
                    required: false
                },
                entry: {
                    required:false
                },
                address: {
                    required:false
                },
                coverTitle: {
                    required:false
                }
            }
        });
    </script>
    <script type="text/javascript">
        /*$(".Cover_Image").click(function () {
            $(".Cover_Image img, .Cover_Image p").css("display","none")
            $(".Cover_Image img, .Cover_Image p").css("display","block")
            // $("#").show();
        });

        $(".Cover_Image").click(function () {
            $(".Cover_Image img, .Cover_Image p").css("display","block")
            $(".Cover_Image img, .Cover_Image p").css("display","none")
            // $("#").show();
        });
        $(".Content_Image").click(function () {
            $(".Content_Image img").css("display","none")
            $(".Content_Image img").css("display","block")
            // $("#").show();
        });

        $(".Content_Image").click(function () {
            $(".Content_Image img, .Content_Image p").css("display","block")
            $(".Content_Image img, .Content_Image p").css("display","none")
            // $("#").show();
        });
        $(".Header_Image").click(function () {
            $(".Header_Image img, .Header_Image p").css("display","none")
            $(".Header_Image img, .Header_Image p").css("display","block")
            // $("#").show();
        });

        $(".Header_Image").click(function () {
            $(".Header_Image img, .Header_Image p").css("display","block")
            $(".Header_Image img, .Header_Image p").css("display","none")
            // $("#").show();
        });*/
    </script>
    <script type="text/javascript">
        /*$(document).ready(function(){
  $('body').append('<a href="#" id="go-top"></a>');
});

$(function() {
 $.fn.scrollToTop = function() {
  $(this).hide().removeAttr("href");
  if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
  var scrollDiv = $(this);
  $(window).scroll(function() {
   if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
   else $(scrollDiv).fadeIn("slow")
  });
  $(this).click(function() {
   $("html, body").animate({scrollTop: 0}, "slow")
  })
 }
});

$(function() {
 $("#go-top").scrollToTop();
});*/
    </script>
@endsection