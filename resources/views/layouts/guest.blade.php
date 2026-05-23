<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $attributes['title'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-dvh bg-[#0a0a0a] font-['Poppins'] text-slate-200 antialiased">

    <div class="relative min-h-dvh flex items-center justify-center px-4">

        <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">

            <div class="absolute top-[-120px] left-[-120px] h-[400px] w-[400px] rounded-full bg-indigo-500/10 blur-3xl">
            </div>

            <div
                class="absolute bottom-[-150px] right-[-150px] h-[450px] w-[450px] rounded-full bg-violet-500/10 blur-3xl">
            </div>

        </div>

        <div class="w-full">
            {{ $slot }}
        </div>

    </div>

</body>

</html>
