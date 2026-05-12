<header class="px-4 sm:px-6 lg:px-8 py-5">

    <div class="max-w-7xl mx-auto flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between"
        x-data="getInfoUser()" x-init="init()">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:gap-14">

            <div class="flex justify-center lg:justify-start">
                <a href="/" class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
                    Pelicul<span class="text-gray-500">app</span>
                </a>
            </div>

            <nav class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 lg:justify-start">

                <a href="/directors"
                    class="group relative px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium uppercase tracking-[0.2em] text-zinc-400 transition duration-200 hover:text-white">

                    Directores

                    <span
                        class="absolute left-4 bottom-0 h-px w-0 bg-white transition-all duration-300 group-hover:w-[calc(100%-2rem)]">
                    </span>
                </a>

                <a href="/films"
                    class="group relative px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium uppercase tracking-[0.2em] text-zinc-400 transition duration-200 hover:text-white">

                    Películas

                    <span
                        class="absolute left-4 bottom-0 h-px w-0 bg-white transition-all duration-300 group-hover:w-[calc(100%-2rem)]">
                    </span>
                </a>

            </nav>
        </div>

        <div class="flex items-center justify-center lg:justify-end">

            <template x-if="user">

                <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-5 w-full sm:w-auto">

                    <div
                        class="w-full sm:w-auto flex items-center justify-center sm:justify-start gap-3 rounded-2xl border border-zinc-700 bg-zinc-900/80 px-4 py-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-zinc-700 text-sm font-bold text-white shrink-0">

                            <span x-text="user.name.charAt(0).toUpperCase()"></span>
                        </div>

                        <div class="flex flex-col leading-tight min-w-0">

                            <span class="text-sm font-medium text-white truncate max-w-[180px]" x-text="user.name">
                            </span>

                            <span class="text-xs text-zinc-500 truncate max-w-[180px]" x-text="user.email">
                            </span>
                        </div>
                    </div>

                    <form method="POST" action="{{ url('api/auth/logout') }}" class="w-full sm:w-auto">
                        @csrf

                        <button type="submit"
                            class="w-full sm:w-auto rounded-lg border border-zinc-700 px-4 py-2.5 text-sm font-medium text-zinc-300 transition hover:border-zinc-500 hover:bg-zinc-800 hover:text-white">

                            Cerrar sesión
                        </button>
                    </form>

                </div>
            </template>

            <template x-if="!user">

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">

                    <a href="/login"
                        class="w-full sm:w-auto text-center px-4 py-2.5 text-sm font-medium text-zinc-300 transition hover:text-white">

                        Iniciar sesión
                    </a>

                    <a href="/register"
                        class="w-full sm:w-auto text-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-black transition hover:bg-zinc-200">

                        Registrarse
                    </a>

                </div>
            </template>

        </div>
    </div>
</header>

<script>
    function getInfoUser() {
        return {
            user: null,

            async init() {
                try {
                    const response = await fetch('/api/auth/me', {
                        headers: {
                            'Accept': 'application/json'
                        },
                        credentials: 'include'
                    });

                    if (response.ok) {
                        this.user = await response.json();
                    }

                } catch (error) {
                    console.error(error);
                    this.user = null;
                }
            }
        }
    }
</script>
