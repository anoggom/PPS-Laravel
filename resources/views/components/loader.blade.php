@props(['text' => 'Cargando...'])

{{-- Componente de loader para usar en caso de funciones asincronas. Implementación en vistas:
    A la hora de usar estilos es para el div principal.
    <x-loader text="Cargando info" class="my-20" />
    <x-loader text="Cargando info" />
--}}

<div x-show="loading" x-cloak {{ $attributes->merge(['class' => 'p-10 text-center text-zinc-500 bg-zinc-900/40']) }}>
    <div class="flex flex-col items-center gap-2">
        <svg class="animate-spin h-12 w-12 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <span class="text-lg font-medium">{{ $text }}</span>
    </div>
</div>
