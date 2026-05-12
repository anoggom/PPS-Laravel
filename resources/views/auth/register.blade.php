<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

        <div class="mb-10 text-center">

            <a href="/" class="text-4xl font-bold tracking-tight text-white">
                Pelicul<span class="text-zinc-500">app</span>
            </a>

            <h1 class="mt-6 text-2xl font-semibold text-white">
                Crear cuenta
            </h1>

            <p class="mt-2 text-sm text-zinc-400">
                Regístrate para empezar a gestionar tus películas
            </p>

        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-8 shadow-xl backdrop-blur">

            <form method="POST" action="{{ url('register') }}" class="space-y-5">

                @csrf

                <div class="space-y-2">

                    <x-input-label for="name" :value="__('Nombre')" class="text-sm text-zinc-300" />

                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Tu nombre"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white placeholder-zinc-600 focus:border-indigo-500 focus:ring-indigo-500" />

                    <x-input-error :messages="$errors->get('name')" class="text-xs" />

                </div>

                <div class="space-y-2">

                    <x-input-label for="email" :value="__('Email')" class="text-sm text-zinc-300" />

                    <x-text-input id="email" type="email" name="email" :value="old('email')" required
                        autocomplete="username" placeholder="correo@ejemplo.com"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white placeholder-zinc-600 focus:border-indigo-500 focus:ring-indigo-500" />

                    <x-input-error :messages="$errors->get('email')" class="text-xs" />

                </div>

                <div class="space-y-2">

                    <x-input-label for="password" :value="__('Contraseña')" class="text-sm text-zinc-300" />

                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white placeholder-zinc-600 focus:border-indigo-500 focus:ring-indigo-500" />

                    <x-input-error :messages="$errors->get('password')" class="text-xs" />

                </div>

                <div class="space-y-2">

                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-sm text-zinc-300" />

                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="••••••••"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white placeholder-zinc-600 focus:border-indigo-500 focus:ring-indigo-500" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-xs" />

                </div>

                <button type="submit"
                    class="mt-2 w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/20">
                    Crear cuenta
                </button>

            </form>

        </div>

        <p class="mt-8 text-center text-sm text-zinc-500">
            ¿Ya tienes cuenta?
            <a href="/login" class="text-white hover:text-indigo-400 transition">
                Iniciar sesión
            </a>
        </p>

    </div>

</x-guest-layout>
