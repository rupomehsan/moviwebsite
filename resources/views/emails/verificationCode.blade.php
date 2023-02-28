<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2 style="text-align: center; font-size:24px">Thank's for Registering on {{ $system_name ?? '' }} </h2> <br>

    <div style="text-align: center; font-size:20px">Login Credentials</div> <br>
    <div style="text-align: center; font-size:14px">Email</div>
    <div style="text-align: center; font-size:20px">{{ $email ?? '' }}</div> <br>
    <div style="text-align: center; font-size:14px">Password</div>
    <div style="text-align: center; font-size:20px">{{$password ?? '' }}</div> <br>
    <div style="text-align: center; font-size:14px">Parental Password</div>
    <div style="text-align: center; font-size:20px">{{ $parental_password ?? '' }}</div> <br> <br>

    <div style="text-align: center">

        <a href="{{ $login_link ?? '' }}"
            style="    background: #35316E;
        color: white;
        text-decoration: none;
        padding: 5px 12px;
        border-radius: 14px;">
            LOGIN TO YOUR ACOUNT
        </a>
    </div>

</body>

</html>
