<x-guest-layout>
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mx-4">
        @csrf

        <div class="text-center mb-4">
            <img src="/Assets/images/Logo.png" class="img-fluid" style="max-width: 100px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));">
        </div>


        <div>
            <x-text-input id="email" class="block mt-1 w-100 px-2 input-custom text-dark" style="border: none; outline: none;" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder=" Masukan Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-100 px-2 input-custom text-dark"
                            style="border: none; outline: none;"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Masukan Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" style="cursor: pointer;" name="remember">
                <span class="ms-2 text-sm text-dark">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="d-flex flex-column items-center justify-end mt-2">
            @if (Route::has('password.request'))
            <a class="text-decoration-none text-sm text-dark hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark" href="{{ route('password.request') }}">
                 {{ __('Lupa Password') }}
            </a>

            @endif

            <x-primary-button class="mt-4 bg-success animated-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <style>
        .input-custom {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .input-custom:focus {
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }

        .animated-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .animated-button:hover {
            background-color: #218838;
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .animated-button:active {
            transform: translateY(0);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-guest-layout>
