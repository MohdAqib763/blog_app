<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h1> Hi {{ $data['full_name'] }}</h1>
    <p>Please verify your email {{ $data['email'] }}</p>
    <p>CLick on verify button link below </p>
    <form action="{{url('/verify_email')}}" method='POST'>
        @csrf
        <input type="hidden" name="email" value="{{ $data['email']  }}">
    <button type="submit" class="btn btn-success">Verify Email</button>
    </form>
</body>
</html>