
@extends('layouts.default-admin')

@section('content')
    <h2>Create hall</h2>
    <form method="get" action="{{action('HallController@create')}}">
        <select name="cinema" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden >Select cinema</option>
            @foreach($cinemas as $cinema)
                <option name="cinema" value="{{$cinema->id}}">{{$cinema->name}}</option>
            @endforeach
        </select><br>
        <button class="btn btn-lg btn-primary">Create hall</button>
    </form>

    <h2>Go hall</h2>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <form method="get" action="{{action('HallController@goHall')}}">
        <select id="cinema" name="cinema" onchange="" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden>Select cinema</option>
            @foreach($cinemas as $cinema)
                <option value="{{$cinema->id}}">{{$cinema->name}}</option>
            @endforeach
        </select><br>
        <select id="halls" name="hall" class="form-control form-control-lg" style="width: 300px" required>
            <option value="" disabled selected hidden>Select hall</option>
        </select><br>
       <button class="btn btn-lg btn-primary">Go hall</button>
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

