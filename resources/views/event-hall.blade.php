@extends('layouts.default')

@section('content')
    <div class="greatest_showman">
        <div class="left-column">
            <div class="caption">
                <h1>{{$event->title}}</h1>
            </div>
            <div class="price">
                <p>Price</p>
                @foreach($sectors as $sector)
                    <div class="button top-price" style="background: {{$sector->color}}">
                        <p>{{$sector->price / 100}} P</p>
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
                                            <label for="{{$sector->id."-".$i."-".$j.'-'.$sector->name}}" class="label{{$sector->id."-".$i."row".$j."place"}}" style="border: 1px solid {{$sector->color}}"></label>
                                            <input type="hidden" class="sector-color" value="{{$sector->color}}">
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
                <p class="category">
                    @foreach($categories as $category)
                        {{$category->title}},
                    @endforeach
                </p>
                <p class="name">{{$event->title}}</p>
                <p class="address">{{$cinema->address}}</p>
                <div class="time-line">
                    <img src="{{asset('img/pics/calendar-blue.svg')}}" alt="">
                    <p>{{date('M. d',strtotime($event->dateStart))}} - {{date('M. d, Y',strtotime($event->dateStart))}}</p>
                </div>
                <div class="time-start">
                    <img src="{{asset('img/pics/clock-blue.svg')}}" alt="">
                    <p>Start {{date('h:i A',strtotime($event->timeStart))}} - End {{date('h:i A',strtotime($event->timeEnd))}}</p>
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
                <form method="post" action="{{action('PaypalController@payWithpaypal')}}">
                    @csrf
                    <div id="total">
                        <input type="hidden" name="amount" id="oldTotal" value=""><h1>Total: </h1>
                        <input id="guid" type="hidden" name="guid" value="">
                    </div>
                    <button class="next"><p>Next</p></button>
                </form>
            </div>
            <div class="time-left">
                <h1>Time left:</h1>
                <div class="day">
                    <p id="days">00</p>
                    <h2>DAY</h2>
                </div>
                <p>:</p>
                <div class="hour">
                    <p id="hours">00</p>
                    <h2>HOUR</h2>
                </div>
                <p>:</p>
                <div class="min">
                    <p id="minutes">00</p>
                    <h2>MIN</h2>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function S4() {
            return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        }

        var now = $.now()/1000;
        var dateStart = Date.parse("{{$event->dateStart.'T'.$event->timeStart.'Z'}}")/1000;
        var remain_bv = dateStart - now;

        function parseTime_bv(timestamp){
            if (timestamp < 0) timestamp = 0;

            var day = Math.floor( (timestamp/60/60) / 24);
            var hour = Math.floor(timestamp/60/60);
            var mins = Math.floor((timestamp - hour*60*60)/60);
            var left_hour = Math.floor( (timestamp - day*24*60*60) / 60 / 60 );

            if(String(day).length > 1)
                $('#days').text(day);
            else
                $('#days').text("0" + day);

            if(String(left_hour).length > 1)
                $('#hours').text(left_hour);
            else
                $('#hours').text("0" + left_hour);

            if(String(mins).length > 1)
                $('#minutes').text(mins);
            else
                $('#minutes').text("0" + mins);
        }

        function setTime(){
            remain_bv = remain_bv - 1;
            parseTime_bv(remain_bv);
        }

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
            total = (Math.ceil((total)*100)/100);

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

            $.post("{{asset('get-session')}}", {}, function (response) {
               if(response != 'false'){
                   var total = 0;
                   var tikets = 0;
                   for(var i = 0; i < response.length; i++){
                       tikets++;
                       total += Number(response[i].price);
                       var label = $('.label'+response[i].sectorId+'-'+response[i].row+'row'+response[i].place+'place');
                       label.addClass('clicked');
                       var color = label.parent().find('.sector-color').val();
                       label.css({background: color + " url({{asset('img/pics/check.png')}}) no-repeat 50% 50%"});
                           $('#place-iformation').append(
                               "<div class='container-cost' price="+response[i].price+">" +
                               "<div class='tiket-column row-column'><p class='row'>"+response[i].row+"</p>" +
                               "</div><div class='tiket-column place-column'><p class='place'>"+response[i].place+"</p>" +
                               "</div><div class='tiket-column price-column'><p class='ticket-price'>"+response[i].price+"</p>" +
                               "</div><div class=\"tiket-column cancel-column\"><div class='cancel'>" +
                               "</div></div>" +
                               "<input type='hidden' class='sectorId' value="+response[i].sectorId+">" +
                               "</div>"
                           );
                   }
                   total = (Math.ceil((total) * 100) / 100);
                   $('#total').append('<input type="hidden" name="amount" id="oldTotal" value="' + total + '">');
                   $('#total').find('h1').text('Total: $' + total);
                   $('#tikets > #totalTikets').find('h1').text('Tickets: ' + tikets);


                   $('.container-cost').find('.cancel').on('click', function () {
                       var id = $(this).closest('.container-cost').find('.sectorId').val();
                       var row = $(this).closest('.container-cost').find('.row').text();
                       var place = $(this).closest('.container-cost').find('.place').text();
                       var lab = $('.label' + id + '-' + row + 'row' + place + 'place');
                       lab.removeClass('clicked');
                       cancelPlace($(this));
                       lab.css({background: ""});
                       tikets--;
                   });
               }
            });


            var tikets = 0;

            $.post("{{asset('sales-places')}}", {eventId: "{{$event->id}}"}, function (response) {
                for(var i = 0; i <= response.length; i++){
                    if(typeof response[i] == 'object') {
                        var row = response[i].name.split(' ')[0];
                        var place = response[i].name.split(' ')[1];
                        $('.label' + response[i].sector_id + '-' + row + place).css({border: '1px solid #c7ddfe', backgroundColor: '#e8f1ff', pointerEvents: 'none'});
                    }
                }
            });

            $('label').on('click', function () {
                if (!$(this).hasClass('clicked')) {
                    $(this).addClass('clicked');
                    tikets++;
                    var label = $(this);
                    var labelFor = label.parents()['context']['attributes'][0]['nodeValue'];

                    var price = 0;
                    $('#total > input').empty();

                    $.post("{{asset('/get-sector')}}", {sectorId: labelFor.split('-')[0]}, function (response) {
                        if (response) {
                            price = response['price'] / 100;
                            var total = price;
                            label.css({background: response['color'] + " url({{asset('img/pics/check.png')}}) no-repeat 50% 50%"});
                            var row = "<div class='container-cost' price=\"{0}\" tikets=\"{1}\">" +
                                "<div class='tiket-column row-column'><p class='row'>{2}</p>" +
                                "</div><div class='tiket-column place-column'><p class='place'>{3}</p>" +
                                "</div><div class='tiket-column price-column'><p class='ticket-price'>{4}</p>" +
                                "</div><div class=\"tiket-column cancel-column\"><div class='cancel'>" +
                                "</div></div>" +
                                "<input type='hidden' class='sectorId' value=\"{5}\">" +
                                "</div>";
                            row = row.format(price, tikets, labelFor.split('-')[1], labelFor.split('-')[2], price, response['id']);
                            var dataRow = $(row);

                            $(document).find('.container-cost').each(function () {
                                var currentPrice = Number($(this).attr('price'));
                                total += currentPrice;
                            });
                            dataRow.find('.cancel').on('click', function () {
                                label.removeClass('clicked');
                                cancelPlace($(this));
                                label.css({background: ""});
                                tikets--;
                            });
                            $('#tikets > #place-iformation').append(dataRow);

                            total = (Math.ceil((total) * 100) / 100);
                            $('#total').append('<input type="hidden" name="amount" id="oldTotal" value="' + total + '">');
                            $('#total').find('h1').text('Total: $' + total);
                            $('#tikets > #totalTikets').find('h1').text('Tickets: ' + tikets);
                        }
                    });
                }else {
                    alert('This place you have already chosen');
                }
            });

            $('.next').on('click', function () {

                if ($("#total>h1").text().length == 7 || $("#total>h1").text() == 'Total: $0')
                {
                    alert('You did not choose the place');
                    return false;
                }

                var tickets = [];
                var amount = 0;

                $(document).find('.container-cost').each(function() {
                    amount += Number($(this).attr('price'));
                    tickets.push({
                        sectorId: $(this).find('.sectorId').val(),
                        row : $(this).find('.row').text(),
                        place : $(this).find('.place').text(),
                        price: $(this).find('.ticket-price').text(),
                        address: $('.address').text(),
                        date: "{{$event->dateStart}}",
                        time: "{{$event->timeStart}}",
                        eventImage: "{{$event->coverImage}}",
                        eventName: "{{$event->title}}",
                        eventId: "{{$event->id}}"
                    });
                });
                $.post("{{asset('save-ticket')}}", {tickets: tickets, amount: amount, guid: $('#guid').val()}, function (response) {

                });

                $.post("{{asset('set-session')}}", {tickets: tickets}, function (response) {

                });
            });

            setInterval(function(){
                setTime();
            }, 1000);
            setTime();


            var guid = (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();

            $('#guid').val(guid);

        });
    </script>
@endsection
