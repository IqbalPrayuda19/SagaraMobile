<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mx-4" style="font-family; 'Poppins', sans-serif;">
        @csrf

        <div class="logo d-flex justify-content-center mb-4">
            <img src="/Assets/logo/Logo.png" class="img-fluid" style="max-width: 100px; height: 60px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));" alt="Logo" srcset="">
        </div>
        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block mt-1 w-100 px-2 input-custom text-dark" style="border: none; outline: none;" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder=" Masukan Email" />
            <x-text-input id="email" class="block mt-1 w-100 px-2" style="border: none; outline: none;" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder=" Masukan Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-100 border-none px-2">
                            style="border: none; outline: none;"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Masukan Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" style="cursor: pointer;" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="d-flex flex-column items-center justify-end mt-2">
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password') }}
                </a>
            @endif

            <x-primary-button class="mt-4 bg-success">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        
    </form>
</x-guest-layout>
