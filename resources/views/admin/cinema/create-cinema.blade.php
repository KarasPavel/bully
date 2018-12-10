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
                <form method="post" action="{{action('CinemaController@store')}}" enctype="multipart/form-data">
                    @csrf

                    <p>Add cinema</p>
                    <div class="label">
                        <input id="title" type="text" name="title" placeholder="cinema name" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" required>
                    </div>
                    @if ($errors->has('title'))
                        <p>{{ $errors->first('title') }}</p>
                    @endif

                    <div class="label">
                        <input id="address" type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Location" value="{{ old('address') }}" required>
                    </div>
                    @if ($errors->has('address'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                    <input  class="file" type="file" name="image" id="Content_Image">
                    <label class="Content_Image" for="Content_Image">
                        <p>Upload Image</p>
                    </label>
                    @if ($errors->has('image'))
                        <p>{{ $errors->first('image') }}</p>
                    @endif
                    <div class="label">
                        <input id="lng" type="text" name="lng"  class="lng" value="" required>
                    </div>
                    <div class="label">
                        <input id="lat" type="text" name="lat"  class="lat" value="" required>
                    </div>
                    <input class="submit" type="submit" name="submit" value="CREATE">
                </form>
            </div>
            <div id="demo"></div>
        </div>
    </div>
    <script type="text/javascript" >
        var map;

        function initMap(uluru) {
            //var uluru = {lat:49.992, lng:36.218};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: uluru
            });

            //getCurrentLocation();

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
                    
                    if (status == google.maps.GeocoderStatus.OK) {

                        var address = (results[0].formatted_address);

                        $('#address').val(address);
                    }
                });

            });
        }

        function getCurrentLocation(){
            $.getJSON('https://ipinfo.io/geo', function(response) {
                var loc = response.loc.split(',');
                var coords = {
                    lat: parseFloat(loc[0]),
                    lng: parseFloat(loc[1])
                };
                //map.setCenter(coords);
                initMap(coords);
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
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDsQm54eyHT6w2O3cyxMvE1HAZNBLtHAk&callback=getCurrentLocation" type="text/javascript">
    </script>
@endsection