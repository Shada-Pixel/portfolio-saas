<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <title>Document</title>
</head>
<body>
<?php
    $inStyle = 'style';
    $style = 'margin-top:';
?>
<div class="d-flex justify-content-lg-center" {{$inStyle}}="{{$style}}200px;">
    <a class="btn btn-outline-primary" href="{{route('user.register')}}">Register User</a>
</div>
</body>
</html>
