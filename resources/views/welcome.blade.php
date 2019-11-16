<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name')}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body>
    <div class="full-height" id="app">
        <div class="container py-2 links mb-5">
            <div class="d-flex justify-content-between">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
                <div>
                    @auth
                        <a href="{{ url('/teams') }}" class="mr-3">Teams</a>
                        <a href="{{ url('/home') }}" class="mr-3">Home</a>
                    @else
                        <a role="button" class="pointer mr-3 text-underline" data-toggle="modal" data-target="#authModal">Login</a>

                        <a href="/register">Register</a>

                        <auth-modal url="{{ config('app.url') }}"></auth-modal>
                    @endauth
                </div>
            </div>
        </div>
        
        <div class="container d-flex flex-column justify-content-center align-items-center">
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" async></script>
</body>
</html>
