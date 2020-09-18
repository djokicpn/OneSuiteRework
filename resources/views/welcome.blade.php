<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            .router-link-active {
                font-weight: bold;
            }
        </style>
        <link href="{{ mix('css/app.css')}}" rel="stylesheet">
    </head>
    <body>

        <div id="app">
            <app></app>
        </div>

        <script src="{{ mix('js/app.js')}}"></script>
    </body>
</html>
