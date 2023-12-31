<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/sass/main.sass','resources/js/app.js']);
    <title>@yield('title', env('APP_NAME'))</title>
</head>
<body class="antialiased">
@include('shared.flash')

@include('shared.header')

    <main class="py-16 lg:py-20">
         <div class="container">
        @yield('content')
         </div>
    </main>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="./js/app.js"></script>

@include('shared.footer')
</body>
</html>
