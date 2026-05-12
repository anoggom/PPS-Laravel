<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

        <div class="mb-10 text-center">

            <a href="/" class="text-4xl font-bold tracking-tight text-white">
                Pelicul<span class="text-zinc-500">app</span>
            </a>

            <h1 class="mt-6 text-2xl font-semibold text-white">
                Iniciar sesión
            </h1>

            <p class="mt-2 text-sm text-zinc-400">
                Accede a tu cuenta para continuar
            </p>

        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-8 shadow-xl backdrop-blur">

            <x-auth-session-status class="mb-5 text-center text-sm" :status="session('status')" />

            <form method="POST" action="{{ url('login') }}" class="space-y-5">

                @csrf

                <div class="space-y-2">

                    <x-input-label for="email" :value="__('Email')" class="text-sm text-zinc-300" />

                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="correo@ejemplo.com"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white placeholder-zinc-600 focus:border-indigo-500 focus:ring-indigo-500" />

                    <x-input-error :messages="$errors->get('email')" class="text-xs" />

                </div>

                <div class="space-y-2">

                    <div class="flex items-center justify-between">

                        <x-input-label for="password" :value="__('Contraseña')" class="text-sm text-zinc-300" />

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-zinc-500 hover:text-white transition">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif

                    </div>

                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white placeholder-zinc-600 focus:border-indigo-500 focus:ring-indigo-500" />

                    <x-input-error :messages="$errors->get('password')" class="text-xs" />

                </div>

                <label class="flex items-center gap-3 text-sm text-zinc-400">

                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-zinc-600 bg-zinc-900 text-indigo-600 focus:ring-indigo-500">

                    Recordarme

                </label>

                <button type="submit"
                    class="mt-2 w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/20">
                    Iniciar sesión
                </button>

            </form>

        </div>

        <p class="mt-8 text-center text-sm text-zinc-500">
            ¿No tienes cuenta?
            <a href="/register" class="text-white hover:text-indigo-400 transition">
                Crear cuenta
            </a>
        </p>

    </div>

</x-guest-layout>
