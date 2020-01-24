<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Hello {{ $name }}</h1>
    An account has been created for you at <a href="{{ route('index') }}">Blober</a>. <br>
    Your login credentials are as follows:
    <br><br>
    Email: {{ $email }}<br>
    Password: {{ $password }}
</body>
</html>