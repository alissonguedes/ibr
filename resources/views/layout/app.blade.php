<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimal-ui">
    <meta name="description" content="{{ config('site.description') }}">
    <meta name="keywords" content="{{ config('keywords') }}">
    <meta name="author" content="{{ config('author') }}">
    <meta name="robots" content="{{ config('site.robots') }}">
    <meta name="theme-color" content="{{ config('theme-color') }}">
    <meta name="manifest.json" rel="manifest">

    <meta property="og:title" content="{{ config('title') }}">
    <meta property="og:image" content="{{ config('og:image') }}">
    <meta property="og:description" content="{{ config('description') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="{{ config('og:type') }}">
    <meta property="og:locale" content="{{ config('og:locale') }}">
    <meta property="og:site_name" content="{{ config('title') }}">

    <link rel="preload" href="{{ asset('img/site/logo/logo-vertical.png') }}" as="image">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="manifest" href="{{ url('/site.webmainfest') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/favicon.ico') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ url('/android-launcherincon-512-512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/apple-touch-icon.png') }}">

    @section('site-title', config('site.title'))
    <title>@yield('site-title')</title>

    @section('styles')
        {!! includes('defaults.styles') !!}
    @show

</head>

<body>

    @section('content')
        Novo App
    @show

    @section('scripts')
        {!! includes('defaults.scripts') !!}
    @show

</body>

</html>
