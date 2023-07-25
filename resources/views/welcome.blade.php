<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Api Pokemon</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('fav icon link') }}"/>
        @vite('resources/css/app.css')

    </head>
    <header>
        
    </header>
    <body>
        <div id="app">
            <app-component></app-component>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
