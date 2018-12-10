@extends('layouts.default')

@section('content')

    <div class="greatest_showman">
        <div class="left-column">
            <div class="caption">
                <h1>The Greatest Showman</h1>
            </div>
            <div class="price">
                <p>Price</p>
                @foreach($sectors as $sector)
                    <div class="button top-price" style="background: {{$sector->color}}">
                        <p>$ {{$sector->price / 100}}</p>
                    </div>
                @endforeach
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form class="scene" id="buy-ticked">
                <p>Scene</p>
                @foreach($sectors as $sector)
                    <div class="red-rows">
                        <table style="margin-top: 30px; max-width: 740px;">
                            @for($i = 1; $i <= $sector->cols; $i++)
                                <tr>
                                    @for($j = 1; $j <= $sector->rows; $j++)
                                        <td>
                                            <input type="checkbox" name="place.{{$i."-".$j}}" id="{{$sector->id."-".$i."-".$j}}">
                                            <label for="{{$sector->id."-".$i."-".$j.'-'.$sector->name}}" style="border: 1px solid {{$sector->color}}"></label>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </table>
                    </div>
                @endforeach
            </form>
        </div>
        <div class="right-column">
            <div class="info-bar">
                 <p class="category">MOVIE, ART, DANCe</p>
-                <p class="name">National Academic Theatre of Operetta</p>
-                <p>{{$cinema->address}}</p>
                <div class="time-line">
                    <img src="{{asset('img/pics/calendar-blue.svg')}}" alt="">
                    <p>Feb. 5 - Mar. 20, 2018</p>
                </div>
                <div class="time-start">
                    <img src="{{asset('img/pics/clock-blue.svg')}}" alt="">
                    <p>Start 7:00 pm - End 9:30 PM</p>
                </div>
            </div>
            <div class="tikets" id="tikets">
                <div id="totalTikets">
                    <h1>Tickets: </h1>
                </div>
                <div id="place-iformation">
                    <div class="tiket-column row-column" id="row-column">
                        <h2>ROW</h2>
                    </div>
                    <div class="tiket-column place-column" id="place-column">
                        <h2>PLACE</h2>
                    </div>
                    <div class="tiket-column price-column" id="price-column">
                        <h2>PRICE</h2>
                    </div>
                    <div class="tiket-column cancel-column" id="cancel-column">
                        <div class="fabul"></div>
                    </div>
                </div>
                <form>
                    @csrf
                    <div id="total">
                        <input type="hidden" name="amount" id="oldTotal" value=""><h1>Total: </h1>
                    </div>
                    <button class="next"><p>Next</p></button>
                </form>
            </div>
            <div class="time-left">
                <h1>Time left:</h1>
                <div class="min">
                    <p>15</p>
                    <h2>MIN</h2>
                </div>
                <p>:</p>
                <div class="second">
                    <p>13</p>
                    <h2>SEC</h2>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        if (!String.prototype.format) {
            String.prototype.format = function() {
                var args = arguments;
                return this.replace(/{(\d+)}/g, function(match, number) {
                    return typeof args[number] != 'undefined'
                        ? args[number]
                        : match
                        ;
                });
            };
        }

        function cancelPlace(sender) {
            var parend = sender.closest('.container-cost');

            parend.remove();
            var tikets1 = Number($('#tikets > #totalTikets').find('h1').text().split(' ')[1]);
            tikets1--;

            var total = 0;
            $(document).find('.container-cost').each(function() {
                var currentPrice = Number($(this).attr('price'));
                total += currentPrice;
            });
            total = (Math.ceil((total)*100)/100)

            $('#total').find('h1').text('Total: $' + total);
            $('#total > input').empty();
            $('#total').append('<input type="hidden" name="amount" id="oldTotal" value="'+total+'">');
            $('#tikets > #totalTikets').find('h1').text('Tickets: ' + tikets1);

        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tikets = 0;

            $('label').on('click', function () {
                tikets++;
                var label = $(this);
                var labelFor = label.parents()['context']['attributes'][0]['nodeValue'];

                var price = 0;
                $('#total > input').empty();

                $.post("{{asset('/get-sector')}}", {sectorId: labelFor.split('-')[0]}, function (response) {
                    if (response) {

                        price = response['price'] / 100;
                        var total = price;
                        label.css({ background: response['color'] +" url({{asset('img/pics/check.png')}}) no-repeat 50% 50%"});
                        var row = "<div class='container-cost' price=\"{0}\" tikets=\"{1}\">" +
                            "<div class='tiket-column row-column'><p class='row'>{2}</p>" +
                            "</div><div class='tiket-column place-column'><p class='place'>{3}</p>" +
                            "</div><div class='tiket-column price-column'><p class='ticket-price'>{4}</p>" +
                            "</div><div class=\"tiket-column cancel-column\"><div class='cancel'>" +
                            "</div></div></div>";
                        row = row.format(price, tikets,labelFor.split('-')[1], labelFor.split('-')[2], price);
                        var dataRow = $(row);

                        $(document).find('.container-cost').each(function() {
                            var currentPrice = Number($(this).attr('price'));
                            total += currentPrice;
                        });
                        dataRow.find('.cancel').on('click', function() {
                            cancelPlace($(this));
                            label.css({ background: ""});
                            tikets--;
                        });
                        $('#tikets > #place-iformation').append(dataRow);

                        total = (Math.ceil((total)*100)/100);
                        $('#total').append('<input type="hidden" name="amount" id="oldTotal" value="'+total+'">');
                        $('#total').find('h1').text('Total: $' + total);
                        $('#tikets > #totalTikets').find('h1').text('Tickets: ' + tikets);
                    }
                });
            });
        });
    </script>
@endsection