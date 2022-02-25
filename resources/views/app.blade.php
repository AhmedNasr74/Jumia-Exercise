<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        td, th, tr {
            border: 2px solid #000;
        }
    </style>
</head>
<body>
<div class="container-fluid" id="app">
    @yield('content')
</div>
<script src="{{asset('assets/js/vue.js')}}"></script>
<script src="{{asset('assets/js/axios.js')}}"></script>
<script src="{{ asset('assets/js/laravel-vue-pagination.js') }}"></script>
@stack('script')
</body>
</html>
