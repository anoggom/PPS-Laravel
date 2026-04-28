<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $attributes['title'] }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#0a0a0a] font-['Poppins'] antialiased text-slate-200">
        <div class="min-h-dvh">
            {{--@include('layouts.navigation')--}}

            <header class="bg-gradient-to-b from-zinc-800 to-black border-b border-zinc-800 py-10 px-8">
                <div class="max-w-7xl mx-auto flex justify-between items-end">
                    <div>
                        <h1 class="text-4xl font-bold text-white tracking-tight">Pelicul<a class="text-gray-500">app</a></h1>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="my-6 text-center text-zinc-600 text-xs">
                &copy; {{ date('Y') }} PeliculApp - Gestión de Directores
            </footer>
        </div>
    </body>
</html>
