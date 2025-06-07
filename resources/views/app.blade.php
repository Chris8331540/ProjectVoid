<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta id="metaViewport" name="viewport" content="width=device-width">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Si en algún momento fallan escalados, poner intial-scale=1 y usar el js --}}
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="icon" href="{{ asset('storage/images/app/logoVoidHunter.png') }}" type="image/png" />
        @routes
        @vite(['resources/js/app.ts'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
