<x-guest-layout>
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body px-4 py-5">
            <h4 class="card-title text-center">Forgot Password</h4>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-outline mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                <div class="d-grid gap-2 mt-4">
                    <x-primary-button class="bg-blue-600">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        {{ __('Remembered your password? Log in here') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
