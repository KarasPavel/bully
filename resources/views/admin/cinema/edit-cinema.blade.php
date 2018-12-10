@extends('layouts.default-admin')

@section('content')
    <div class="create-cinema">
        <div class="row">
            <div class="col-md-6">
                <div style="width: 500px; height: 650px; float: right"  >
                    <strong>SELECT THE COORDINATES OF THE CINEMA</strong>
                    <div id="map" style="width: 500px; height: 600px;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <form method="post" action="{{action('CinemaController@update', ['id' => $cinema->id])}}" enctype="multipart/form-data">
                    @csrf
                    <p>Add cinema</p>
                    <div class="label">
                        <input id="title" type="text" name="title" placeholder="cinema name" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $cinema->name }}">
                    </div>
                    @if ($errors->has('title'))
                        <p>{{ $errors->first('title') }}</p>
                    @endif

                    <div class="label">
                        <input id="address" type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Location" value="{{ $cinema->address }}">
                    </div>
                    @if ($errors->has('address'))
                        <span class="invalid-feedback">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                    @endif
                    <input  class="file" type="file" name="image" id="Content_Image">
                    @if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false))
                        <label class="Content_Image" for="Content_Image" style="background-image: url({{$cinema->image}}); background-size: 100% 100%">
                            <p>Upload Image</p>
                        </label>
                    @else
                        <label class="Content_Image" for="Content_Image" style="background-image: url({{asset(stristr($cinema->image, 'img'))}}); background-size: 100% 100%">
                            <p>Upload Image</p>
                        </label>
                    @endif
                    @if ($errors->has('image'))
                        <p>{{ $errors->first('image') }}</p>
                    @endif
                    <div class="label">
                        <input id="lng" type="text" name="lng"  class="lng" value="{{$cinema->lng}}">
                    </div>
                    <div class="label">
                        <input id="lat" type="text" name="lat"  class="lat" value="{{$cinema->lat}}">
                    </div>
                    <input type="hidden" name="oldImage" value="{{$cinema->image}}">
                    <input class="submit" type="submit" name="submit" value="CREATE">
                </form>
            </div>
        </div>
    </div>
    <script>
        function initMap() {
            if($('#lat').val()){
                var lat = parseFloat($('#lat').val());
            }else{
                var lat = 0;
            }
            if($('#lng').val()){
                var lng = parseFloat($('#lng').val());
            }else {
                var lng = 0;
            }

            var uluru = {lat:lat, lng:lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: uluru
            });

            var marker;
            function placeMarker(location) {
                if ( marker ) {
                    marker.setPosition(location);
                } else {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
            }

            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
                var pos = marker.getPosition();
                $('#lat').val(pos.lat());
                $('#lng').val(pos.lng());
                var latlng = new google.maps.LatLng(pos.lat(), pos.lng());
                var geocoder= new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status !== google.maps.GeocoderStatus.OK) {
                        alert(status);
                    }
                    if (status == google.maps.GeocoderStatus.OK) {
                        var address = (results[0].formatted_address);
                        $('#address').val(address);
                    }
                });
            });
        }
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.'+input.id).css({'backgroundImage': 'url('+e.target.result+')','background-size': '100% 100%'});
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).click(function () {
            $('.file').on('change', function () {
                readURL(this);
            });
        });
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDsQm54eyHT6w2O3cyxMvE1HAZNBLtHAk&callback=initMap" type="text/javascript">
    </script>
@endsection