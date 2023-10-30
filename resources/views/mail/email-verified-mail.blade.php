<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Name:{{ $mailData['name'] }}</h1>
    <a href="{{route('sub_admin.verify_email',['token'=>$mailData['token']])}}">Verify the email</a>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat, natus.</p>
</body>
</html>