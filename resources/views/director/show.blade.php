<x-app-layout title="Perfil de {{ $director->name }}">
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <a href="{{ route('directors.index') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-400 border border-indigo-400/30 rounded-lg hover:bg-indigo-400 hover:text-white transition-all duration-300">
                Volver al listado
            </a>
        </div>

        <div class="flex flex-col gap-8">
            
            <div class="card text-zinc-400 bg-zinc-900/40 border border-zinc-800 p-8 rounded-xl backdrop-blur-sm">
                <div class="card-body flex flex-col gap-4">
                    <h5 class="card-title text-4xl text-zinc-200">
                        {{ $director->name }} <span class="text-zinc-400">{{ $director->surname }}</span>
                    </h5>
                    <p class="card-text flex items-center gap-2">
                        <span class="text-indigo-400 font-semibold">Nacimiento:</span> 
                        {{ \Carbon\Carbon::parse($director->birthdate)->translatedFormat('d M, Y') }}
                    </p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-zinc-400 text-2xl mb-6 flex items-center gap-3">
                    Películas dirigidas
                    <span class="h-px flex-1 bg-zinc-800"></span>
                </h3>

                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($director->films as $film)
                        <div class="group bg-zinc-900/50 border border-zinc-800 p-6 rounded-xl hover:border-indigo-500/50 transition-all duration-300 shadow-xl">
                            <div class="flex flex-col h-full gap-4">
                                
                                <div class="flex justify-between items-start">
                                    <h4 class="text-zinc-100 text-xl font-bold group-hover:text-indigo-400 transition-colors">
                                        {{ $film->title }}
                                    </h4>
                                    <span class="text-xs font-mono bg-zinc-800 text-zinc-500 px-2 py-1 rounded">
                                        {{ \Carbon\Carbon::parse($film->release_date)->format('Y') }}
                                    </span>
                                </div>

                                
                                <div class="flex gap-2 flex-wrap">
                                    <span class="px-2 py-1 rounded-md bg-indigo-500/10 text-indigo-400 text-xs border border-indigo-500/20">
                                        {{ $film->gendre }}
                                    </span>
                                    <span class="px-2 py-1 rounded-md bg-zinc-800 text-zinc-400 text-xs">
                                        {{ $film->duration }} min
                                    </span>
                                </div>

                                
                                <p class="text-zinc-400 text-sm line-clamp-3 leading-relaxed">
                                    {{ $film->sinopsis }}
                                </p>

                                
                                <div class="mt-auto pt-4 border-t border-zinc-800/50 flex justify-between items-center">
                                    <span class="text-xs text-zinc-500 italic">
                                        Estreno: {{ \Carbon\Carbon::parse($film->release_date)->translatedFormat('d M, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-app-layout>