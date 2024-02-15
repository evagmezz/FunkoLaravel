<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

@include('link')
</head>

<body>

<div class="container">

    @include('header')

    <div class="mx-2 my-2">
        @include('flash::message')
    </div>

    @yield('content')

</div>

@include('footer')

@include('scripts')
</body>
</html>
