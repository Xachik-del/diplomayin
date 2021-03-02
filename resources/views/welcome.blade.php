<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <!-- Styles -->
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" rel="stylesheet">
{{--        <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
                color: #333;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <App/>
        </div>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
        <script src="https://kit.fontawesome.com/1283134da2.js" crossorigin="anonymous"></script>
    </body>
</html>
