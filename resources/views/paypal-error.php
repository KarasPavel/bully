<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!--<link rel="stylesheet" type="text/css" href="{{asset('stylesheet.css')}}">-->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/print-tickets.css')}}" media="print">
    <script type="text/javascript" src="{{asset('js/admin/jquery-1.11.1.js')}}"></script>
    <title>Ticket</title>
</head>
<body>
@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert">
        <span onclick="this.parentElement.style.display='none'"
              class="w3-button w3-red w3-large w3-display-topright">&times;</span>
    <p>{!! $message !!}</p>
</div>
<?php Session::forget('error');?>
@endif
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
</body>
</html>