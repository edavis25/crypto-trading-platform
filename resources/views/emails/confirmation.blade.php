<!DOCTYPE html>
<html> 
    <head>
        <title></title>
    </head>
    <body>
        <p>Welcome to CryptX, {{ $user->name }}!</p>
        <p>To continue logging into your account, please verify your email using the link below!</p>
        <p>
            <a href="{{ URL::to('register/verify/' . $user->email_token) }}">
                {{ URL::to('register/verify/' . $user->email_token) }}
            </a>
        </p>
    </body>
</html>