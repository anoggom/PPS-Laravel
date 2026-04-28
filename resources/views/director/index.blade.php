<x-app-layout title="Panel de Directores">
        <div class="min-h-screen ">
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <h3 class="text-zinc-400 pt-4 pb-12 text-3xl">Directores</h3>
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden backdrop-blur-sm shadow-2xl">
                <x-table :header="$header" :tableData="$tableData"/>
            </div>
        </main>
    </div>
</x-app-layout>