<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light"> {{-- Fundo claro do Bootstrap --}}
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>