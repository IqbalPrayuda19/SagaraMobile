<x-guest-layout>
    <section style=" font-family: 'Poppins', sans-serif; background-color: #435ebe;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <!-- Logo -->
                            <div class="text-center mb-4">
                                <img src="/Assets/logo/Logo.png" class="img-fluid" style="max-width: 100px; height: 60px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));" alt="Logo">
                            </div>

                            <h3 class="mb-4 text-center">Register</h3>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-outline mb-4">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="form-control form-control-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan Nama" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>

                                <!-- Email -->
                                <div class="form-outline mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan Email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>

                                <!-- Password -->
                                <div class="form-outline mb-4">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan Password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-outline mb-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>

                                <!-- Submit -->
                                <x-primary-button class="btn btn-primary btn-lg btn-block w-100 mb-3">
                                    {{ __('Register') }}
                                </x-primary-button>

                                <!-- Redirect to login -->
                                <div class="text-center">
                                    <a class="text-decoration-none text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Sudah punya akun? Login') }}
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
