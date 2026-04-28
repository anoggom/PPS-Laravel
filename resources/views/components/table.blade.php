<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-zinc-800">
    <table class="w-full text-sm text-left text-zinc-400">
        <thead class="text-xs uppercase bg-zinc-800/80 text-zinc-300">
            <tr>
                @foreach ($header as $index)
                    <th scope="col" class="px-6 py-4 font-bold text-center"> {{$index}} </th>
                @endforeach
                <th scope="col" class="px-6 py-4 font-bold text-center"> Acciones </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-800">
            @foreach ($tableData as $item)
                <tr class="bg-zinc-900/40 border-b border-zinc-800 hover:bg-zinc-800/60 transition-all duration-200 group">
                    <td class="px-6 py-4 text-center whitespace-nowrap text-zinc-100 font-medium">
                        {{ $item->name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $item->surname }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 rounded-md bg-zinc-800 text-zinc-400 text-xs">
                            {{ \Carbon\Carbon::parse($item->birthdate)->translatedFormat('d M, Y') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('directors.show', $item->id) }}" 
                           class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-400 border border-indigo-400/30 rounded-lg hover:bg-indigo-400 hover:text-white transition-all duration-300">
                            Ver perfil
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($tableData->hasPages())
        <div class="px-6 py-4 bg-zinc-800/10 border-t border-zinc-800 flex items-center justify-between">
            <div class="text-xs text-zinc-500 font-medium">
                Mostrando <span class="text-zinc-300">{{ $tableData->firstItem() }}</span> - <span class="text-zinc-300">{{ $tableData->lastItem() }}</span> de {{ $tableData->total() }}
            </div>
            
            <div class="flex gap-2">
                @if ($tableData->onFirstPage())
                    <span class="px-3 py-1 text-xs text-zinc-600 bg-zinc-800/50 rounded-md cursor-not-allowed">Anterior</span>
                @else
                    <a href="{{ $tableData->previousPageUrl() }}" class="px-3 py-1 text-xs text-zinc-300 bg-zinc-800 hover:bg-zinc-700 rounded-md transition-colors">Anterior</a>
                @endif

                @if ($tableData->hasMorePages())
                    <a href="{{ $tableData->nextPageUrl() }}" class="px-3 py-1 text-xs text-zinc-300 bg-zinc-800 hover:bg-zinc-700 rounded-md transition-colors">Siguiente</a>
                @else
                    <span class="px-3 py-1 text-xs text-zinc-600 bg-zinc-800/50 rounded-md cursor-not-allowed">Siguiente</span>
                @endif
            </div>
        </div>
    @endif
</div>