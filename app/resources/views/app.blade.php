<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/svg" sizes="64x64" href="{{ asset('/img/rental-house.svg') }}">
    <meta name="title" content="Rental house" />
    <meta name="description" content="rental house" />
    @csrf

    <!-- Scripts -->
    @routes
    <title>Rental House</title>
    @vite('resources/js/bootstrap.js')
    @vite('resources/js/app.js')
{{--    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}"--}}
{{--          crossorigin="anonymous"--}}
{{--          referrerpolicy="no-referrer" />--}}
{{--    <link rel="stylesheet" href="{{ asset('scss/style.css.map') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('scss/style.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">--}}
</head>

{{-- <body class=""> --}}
@inertia
{{-- </body> --}}
</html>
