<x-app-layout title="Detalle de Película">
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" x-data="filmProfileManager()" x-init="fetchFilm({{ $id }})">

        <div class="mb-8">
            <a href="{{ route('films.index') }}"
                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-400 border border-indigo-400/30 rounded-lg hover:bg-indigo-400 hover:text-white transition-all duration-300">
                Volver al listado
            </a>
        </div>

        <!-- Loader que se muestra cuando se haga la petición a la API -->
        <x-loader text="Cargando película" />

        <div x-show="!loading" x-cloak class="flex flex-col gap-8">

            <!-- Tarjeta de informacion de la pelicula -->
            <div class="card text-zinc-400 bg-zinc-900/40 border border-zinc-800 p-8 rounded-xl backdrop-blur-sm">
                <div class="card-body flex flex-col gap-4">
                    <h5 class="card-title text-4xl text-zinc-200">
                        <span x-text="film.title"></span>
                    </h5>
                    
                    <div class="flex gap-2 flex-wrap mb-2">
                        <span
                            class="px-2 py-1 rounded-md bg-indigo-500/10 text-indigo-400 text-xs border border-indigo-500/20"
                            x-text="film.gendre"></span>
                        <span class="px-2 py-1 rounded-md bg-zinc-800 text-zinc-400 text-xs">
                            <span x-text="film.duration"></span> min
                        </span>
                    </div>

                    <p class="card-text flex items-center gap-2">
                        <span class="text-indigo-400 font-semibold">Fecha de estreno:</span>
                        <span x-text="formatDate(film.release_date)"></span>
                    </p>
                    <p class="card-text flex flex-col gap-2">
                        <span class="text-indigo-400 font-semibold">Sinopsis:</span>
                        <span x-text="film.sinopsis" class="text-zinc-300"></span>
                    </p>
                    <p class="card-text flex flex-col gap-2 mt-4" x-show="film.director">
                        <span class="text-indigo-400 font-semibold">Dirigida por:</span>
                        <a :href="'/directors/' + (film.director ? film.director.id : '')" class="text-zinc-300 hover:text-indigo-400 transition-colors">
                            <span x-text="film.director ? (film.director.name + ' ' + film.director.surname) : ''"></span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
    function filmProfileManager() {
        return {
            film: {
                director: {}
            },
            loading: true,

            async fetchFilm(id) {
                this.loading = true;
                try {
                    const response = await fetch(`/api/films/${id}`);
                    const data = await response.json();

                    this.film = data.data ? data.data : data;

                } catch (error) {
                    console.error("Error al obtener la película:", error);
                } finally {
                    this.loading = false;
                }
            },

            formatDate(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleDateString('es-ES', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
