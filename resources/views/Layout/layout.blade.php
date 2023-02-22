<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <title>GlichCode</title>
</head>
<body class="d-flex flex-column min-vh-100">

{{-- CSS --}}
<link rel="stylesheet" href="{{asset('css/header.css')}}">


@include('Layout.header')

@yield('content')

@include('Layout.footer')


{{-- CONEXIONES --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>