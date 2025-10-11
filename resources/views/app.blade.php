<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title inertia>{{ config('app.name') }}</title>
    <meta head-key="description" name="description" content="Call of Duty Wiki - гайды, сборки оружия, карты для Warzone, Black Ops 6, Modern Warfare 3">
    <meta name="keywords" content="Call of Duty, Warzone, Black Ops 6, MW3, гайды, сборки оружия, мета оружие">
    <meta name="author" content="Call of Duty Wiki">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta head-key="og:title" property="og:title" content="{{ config('app.name') }}">
    <meta head-key="og:description" property="og:description" content="Call of Duty Wiki - гайды, сборки оружия, карты для Warzone, Black Ops 6, Modern Warfare 3">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta head-key="twitter:title" property="twitter:title" content="{{ config('app.name') }}">
    <meta head-key="twitter:description" property="twitter:description" content="Call of Duty Wiki - гайды, сборки оружия, карты для Warzone, Black Ops 6, Modern Warfare 3">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    @inertiaHead
</head>
<body class="bg-gray-900 text-white">
    @inertia
</body>
</html>
