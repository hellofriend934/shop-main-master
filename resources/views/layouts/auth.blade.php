<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/sass/main.sass','resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title',env('APP_NAME'))</title>
</head>
@include('shared.flash')
@include('shared.header')
<body class="antialiased">
<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
    <div class="container">

        <!-- Page heading -->
        <div class="text-center">
            <a href="{{route('home')}}" class="inline-block" rel="home">
                <img src="{{\Illuminate\Support\Facades\Vite::image('logo.svg')}}" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
            </a>
        </div>
        @yield('content')
    </div>
</main>
</body>
@include('shared.footer')
</html>
