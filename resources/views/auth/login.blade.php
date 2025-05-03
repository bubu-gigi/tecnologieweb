<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-body">

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Login</h2>

            {!! html()->form('POST', url('login'))->open() !!}
                {{ csrf_field() }}

                <div class="form-group">
                    {{ html()->label('Username', 'username')->class('label-input') }}
                    {{ html()->text('username')->class('input')->id('username') }}
                    <x-field-errors field="username" />
                </div>

                <div class="form-group">
                    {{ html()->label('Password', 'password')->class('label-input') }}
                    {{ html()->password('password')->class('input')->id('password') }}
                    <x-field-errors field="password" />
                </div>

                <div class="form-group">
                    {{ html()->button('Login')->type('submit')->class('button') }}
                </div>

            {{ html()->form()->close() }}
        </div>
    </div>

</body>
</html>
