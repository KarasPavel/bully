@extends('layouts.default-admin')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <form method="get" action="{{action('SectorController@create')}}">
        <select id="cinema" name="cinema" onchange="" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden>Select cinema</option>
            @foreach($cinemas as $cinema)
                <option value="{{$cinema->id}}">{{$cinema->name}}</option>
            @endforeach
        </select><br>
        <select id="halls" name="hall" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden>Select hall</option>
        </select><br>
        <button class="btn btn-lg btn-primary">Create sector</button>
    </form>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#cinema').on('change', function () {
                $('#halls').empty();
                $.post("{{asset('getHalls')}}", { item : $('#cinema').val() }, function (responce) {
                    for (var i = 0; i < responce.length; i++){
                        $('#halls').append('<option value="' + responce[i].id + '">' + responce[i].name + '</option>');
                    }
                });
            });
        });

    </script>
@endsection