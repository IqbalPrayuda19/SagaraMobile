<x-guest-layout>
    <section class="min-vh-100 d-flex align-items-center justify-content-center" style="font-family: 'Poppins', sans-serif; background-color: #435ebe;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-body p-4 p-md-5 text-center">

                            <!-- Logo -->
                            <div class="mb-4">
                                <img src="/Assets/logo/Logo.png" class="img-fluid" style="max-width: 100px; height: 60px; border-radius: 10px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));" alt="Logo">
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

                            <h3 class="mb-4">Sign in</h3>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-outline mb-3 text-start">
                                    <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan Email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>

                                <!-- Password -->
                                <div class="form-outline mb-3 text-start">
                                    <x-text-input id="password" class="form-control form-control-lg" type="password" name="password" required placeholder="Masukkan Password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>

                                <!-- Remember Me -->
                                <div class="form-check d-flex justify-content-start mb-3">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                    <label class="form-check-label ms-2" for="remember_me">Ingat Saya</label>
                                </div>

                                <!-- Submit -->
                                <x-primary-button class="btn btn-primary text-white btn-lg w-100">
                                    {{ __('Login') }}
                                </x-primary-button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
