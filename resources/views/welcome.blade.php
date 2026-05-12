<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="api-token" content="{{ session('jwt_token') }}">

    <title>Peliculapp</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="relative min-h-dvh bg-[#0a0a0a] font-['Poppins'] text-slate-200 antialiased flex flex-col overflow-x-hidden">

    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-120px] left-[-120px] h-[400px] w-[400px] rounded-full bg-indigo-500/10 blur-3xl">
        </div>

        <div class="absolute bottom-[-150px] right-[-150px] h-[450px] w-[450px] rounded-full bg-violet-500/10 blur-3xl">
        </div>
    </div>
    <div>
        <x-header />

        <main class="flex-1 flex items-center justify-center px-6">

            <section class="w-full max-w-6xl py-24">

                <div class="text-center">

                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-900/70 px-4 py-2 text-xs uppercase tracking-[0.25em] text-zinc-400 backdrop-blur-sm">
                        Plataforma de gestión cinematográfica
                    </div>

                    <h1
                        class="mt-8 text-5xl font-extrabold tracking-tight text-white sm:text-6xl lg:text-7xl leading-[1.05]">

                        Encuentra tus
                        <span class="bg-gradient-to-r from-indigo-400 to-violet-500 bg-clip-text text-transparent">
                            películas
                        </span>
                        y directores favoritos
                    </h1>

                    <p class="mx-auto mt-8 max-w-2xl text-lg leading-8 text-zinc-400 sm:text-xl">
                        Consulta, y explora información sobre películas y sus directores de forma rápida,
                        limpia y centralizada.
                    </p>

                    <div class="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row">

                        <a href="/directors"
                            class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-7 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/20">
                            Explorar directores
                        </a>

                        <a href="/films"
                            class="inline-flex items-center justify-center rounded-xl border border-zinc-700 bg-zinc-900/50 px-7 py-3 text-sm font-medium text-zinc-300 transition duration-200 hover:border-zinc-500 hover:bg-zinc-800 hover:text-white">
                            Ver películas
                        </a>

                    </div>

                </div>

                <div class="mt-24 grid gap-6 md:grid-cols-3">

                    <div
                        class="rounded-2xl border border-zinc-800 bg-zinc-900/40 p-6 backdrop-blur-sm transition hover:border-zinc-700 hover:bg-zinc-900/70">

                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400">
                            🎬
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                            Catálogo de películas
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-zinc-400">
                            Consulta información detallada sobre películas, sus títulos y datos asociados.
                        </p>
                    </div>

                    <div
                        class="rounded-2xl border border-zinc-800 bg-zinc-900/40 p-6 backdrop-blur-sm transition hover:border-zinc-700 hover:bg-zinc-900/70">

                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-500/10 text-violet-400">
                            🎭
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                            Directores favoritos
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-zinc-400">
                            Explora información sobre directores y su relación con las películas registradas.
                        </p>
                    </div>

                    <div
                        class="rounded-2xl border border-zinc-800 bg-zinc-900/40 p-6 backdrop-blur-sm transition hover:border-zinc-700 hover:bg-zinc-900/70">

                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500/10 text-pink-400">
                            ⚡
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                            Gestión centralizada
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-zinc-400">
                            Todo el contenido de películas y directores organizado en un único sistema.
                        </p>
                    </div>

                </div>

            </section>

        </main>

        <footer class="py-6 text-center text-sm text-zinc-600">
            © {{ date('Y') }} Peliculapp · Gestión de Directores y Películas
        </footer>
    </div>
</body>

</html>
