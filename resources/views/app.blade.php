<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @routes
    @vite(['resources/css/app.css', "resources/css/Pages/{$page['component']}.vue"])
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    {{-- @vite('resources/css/app.css')
    @vite('resources/js/app.js') --}}
    @inertiaHead
</head>

<body class="font-sans antialiased lg:block">
    @inertia
</body>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</html>
