@extends('layouts.default')

@section('content')
    <div class="greatest_showman">
        <div class="left-column">
            <form class="scene" id="buy-ticked">
                <p>Scene</p>
                @for($i=1; $i<=$countRows; $i++)
                    <div class="red-rows">
                        @for($j=1; $j<=$countPlaces; $j++)
                            <input type="checkbox" name="place" id="">
                            <label for=""></label>
                        @endfor
                    </div>
                @endfor
            </form>
        </div>
    </div>
@endsection