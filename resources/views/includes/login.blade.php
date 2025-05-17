<x-guest-layout>
    <section class="" style="font-family: 'Poppins', sans-serif;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <!-- Logo -->
                            <div class="mb-4">
                                <img src="/Assets/logo/Logo.png" class="img-fluid " style="max-width: 100px; border-radius: 10px; height: 60px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));" alt="Logo">
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

                            <h3 class="mb-4">Sign in</h3>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-outline mb-4 text-start">
                                    <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan Email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>

                                <!-- Password -->
                                <div class="form-outline mb-4 text-start">
                                    <x-text-input id="password" class="form-control form-control-lg" type="password" name="password" required placeholder="Masukkan Password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>

                                <!-- Remember Me -->
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                    <label class="form-check-label ms-2" for="remember_me">Ingat Saya</label>
                                </div>

                                <!-- Submit -->
                                <x-primary-button class="btn btn-primary btn-lg btn-block w-100 mb-3">
                                    {{ __('Login') }}
                                </x-primary-button>

                                <!-- Links -->
                                @if (Route::has('password.request'))
                                    <div class="mb-2">
                                        <a class="text-decoration-none text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Lupa Password?') }}
                                        </a>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <a href="/register" class="text-decoration-none">Belum punya akun? Daftar</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
