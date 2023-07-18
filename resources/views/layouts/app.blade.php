<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/js/app.js'])
</head>

<body class="antialiased">

</body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Monitoring PYDB Cabang Manonjaya</span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{url('/') }}" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="{{ route('anggota.index') }}" class="nav-link">List Anggota</a></li>
            <li class="nav-item"><a href="{{ route('monitoring.index') }}" class="nav-link">Input Monitoring</a></li>
        </ul>
    </header>

    @yield('app')

</div>

</html>
