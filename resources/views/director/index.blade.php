<x-app-layout title="Panel de Directores">
    <div class="min-h-screen ">
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <h3 class="text-zinc-400 pt-4 pb-12 text-3xl">Directores</h3>
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden backdrop-blur-sm shadow-2xl">
                <div x-data="directorManager()" x-init="fetchDirectors()"
                    class="relative overflow-x-auto shadow-md sm:rounded-lg border border-zinc-800">

                    {{-- Loader que se muestra cuando se haga la petición a la API --}}
                    <x-loader text="Cargando directores..." />

                    <table x-show="!loading" class="w-full text-sm text-left text-zinc-400" x-cloak>
                        <thead class="text-xs uppercase bg-zinc-800/80 text-zinc-300">
                            <tr>
                                <template x-for="title in header" :key="title">
                                    <th scope="col" class="px-6 py-4 font-bold text-center" x-text="title"></th>
                                </template>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            <template x-for="item in tableData" :key="item.id">
                                <tr
                                    class="bg-zinc-900/40 border-b border-zinc-800 hover:bg-zinc-800/60 transition-all duration-200 group">
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-zinc-100 font-medium"
                                        x-text="item.name"></td>
                                    <td class="px-6 py-4 text-center" x-text="item.surname"></td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 rounded-md bg-zinc-800 text-zinc-400 text-xs"
                                            x-text="item.birthdate"></span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a :href="'/directors/' + item.id"
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-400 border border-indigo-400/30 rounded-lg hover:bg-indigo-400 hover:text-white transition-all duration-300">
                                            Ver perfil
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <div x-show="!loading && totalRecords > 0"
                        class="px-6 py-4 bg-zinc-800/10 border-t border-zinc-800 flex items-center justify-between">
                        <div class="text-xs text-zinc-500 font-medium">
                            Mostrando <span class="text-zinc-300" x-text="totalRecords"></span> registros
                        </div>
                        <div class="flex gap-2">
                            <button @click="prevPage" :disabled="currentPage === 1"
                                :class="currentPage === 1 ?
                                    'px-3 py-1 text-xs text-zinc-600 bg-zinc-800/50 rounded-md cursor-not-allowed' :
                                    'px-3 py-1 text-xs text-zinc-300 bg-zinc-700 rounded-md hover:bg-zinc-600'">
                                Anterior
                            </button>
                            <button @click="nextPage" :disabled="currentPage >= totalPages"
                                :class="currentPage >= totalPages ?
                                    'px-3 py-1 text-xs text-zinc-600 bg-zinc-800/50 rounded-md cursor-not-allowed' :
                                    'px-3 py-1 text-xs text-zinc-300 bg-zinc-700 rounded-md hover:bg-zinc-600'">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    function directorManager() {
        return {
            tableData: [],
            header: ['Nombre', 'Apellido', 'F. Nacimiento', 'Acciones'],
            loading: true,
            currentPage: 1,
            totalPages: 1,
            totalRecords: 0,
            async fetchDirectors(page = 1) {
                this.loading = true;
                try {
                    const response = await fetch(`/api/directors?page=${page}`);
                    const json = await response.json();
                    this.tableData = json.data;
                    this.currentPage = json.current_page;
                    this.totalPages = json.last_page;
                    this.totalRecords = json.total;
                } catch (error) {
                    console.error("Error al obtener los directores:", error);
                } finally {
                    this.loading = false;
                }
            },
            prevPage() {
                if (this.currentPage > 1) this.fetchDirectors(this.currentPage - 1);
            },
            nextPage() {
                if (this.currentPage < this.totalPages) this.fetchDirectors(this.currentPage + 1);
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
