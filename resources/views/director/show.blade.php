<x-app-layout title="Perfil del Director">
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" x-data="directorProfileManager()" x-init="fetchDirector({{ $id }})">

        <div class="mb-8">
            <a href="{{ route('directors.index') }}"
                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-400 border border-indigo-400/30 rounded-lg hover:bg-indigo-400 hover:text-white transition-all duration-300">
                Volver al listado
            </a>
        </div>

        <!-- Loader que se muestra cuando se haga la petición a la API -->
        <x-loader text="Cargando director" />

        <div x-show="!loading" x-cloak class="flex flex-col gap-8">

            <!-- Tarjeta de informacion del director -->
            <div class="card text-zinc-400 bg-zinc-900/40 border border-zinc-800 p-8 rounded-xl backdrop-blur-sm">
                <div class="card-body flex flex-col gap-4">
                    <h5 class="card-title text-4xl text-zinc-200">
                        <span x-text="director.name"></span>
                        <span class="text-zinc-400" x-text="director.surname"></span>
                    </h5>
                    <p class="card-text flex items-center gap-2">
                        <span class="text-indigo-400 font-semibold">Nacimiento:</span>
                        <span x-text="formatDate(director.birthdate)"></span>
                    </p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-zinc-400 text-2xl mb-6 flex items-center gap-3">
                    Películas dirigidas
                    <span class="h-px flex-1 bg-zinc-800"></span>
                </h3>

                <!-- Grid de Películas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="film in director.films" :key="film.id">
                        <div
                            class="group bg-zinc-900/50 border border-zinc-800 p-6 rounded-xl hover:border-indigo-500/50 transition-all duration-300 shadow-xl">
                            <div class="flex flex-col h-full gap-4">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-zinc-100 text-xl font-bold group-hover:text-indigo-400 transition-colors"
                                        x-text="film.title"></h4>
                                    <span class="text-xs font-mono bg-zinc-800 text-zinc-500 px-2 py-1 rounded"
                                        x-text="new Date(film.release_date).getFullYear()"></span>
                                </div>

                                <div class="flex gap-2 flex-wrap">
                                    <span
                                        class="px-2 py-1 rounded-md bg-indigo-500/10 text-indigo-400 text-xs border border-indigo-500/20"
                                        x-text="film.gendre"></span>
                                    <span class="px-2 py-1 rounded-md bg-zinc-800 text-zinc-400 text-xs">
                                        <span x-text="film.duration"></span> min
                                    </span>
                                </div>

                                <p class="text-zinc-400 text-sm line-clamp-3 leading-relaxed" x-text="film.sinopsis">
                                </p>

                                <div class="mt-auto pt-4 border-t border-zinc-800/50 flex justify-between items-center">
                                    <span class="text-xs text-zinc-500 italic">
                                        Estreno: <span x-text="formatDate(film.release_date)"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Mensaje si no hay películas -->
                <template x-if="director.films && director.films.length === 0">
                    <p class="text-zinc-500 text-center py-10">No se han encontrado películas para este director.
                    </p>
                </template>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
    function directorProfileManager() {
        return {
            director: {
                films: []
            },
            loading: true,

            async fetchDirector(id) {
                this.loading = true;
                try {

                    const response = await fetch(`/api/directors/${id}`);
                    const data = await response.json();

                    this.director = data.data ? data.data : data;

                } catch (error) {
                    console.error("Error al obtener el perfil del director:", error);
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
