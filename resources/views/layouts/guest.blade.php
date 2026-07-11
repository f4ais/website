<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masuk') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-950 via-emerald-800 to-teal-700">
    <main class="flex min-h-screen items-center justify-center px-4 py-10">
        @yield('content')
    </main>
</body>
</html>
