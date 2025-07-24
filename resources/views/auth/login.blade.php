<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-36 w-auto">
            </div>
            
            <div class="flex justify-center mb-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900 font-sans">
                        <a href="/" class="hover:text-blue-600 transition duration-300">
                            Sistem Manajemen Prestasi
                        </a>
                    </h1>
                    <p class="text-sm text-gray-600 mt-2">Login untuk mengakses dashboard</p>
                </div>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center mt-8">
                    <x-primary-button class="w-full flex justify-center py-3 bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out hover:scale-105">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
            
            <div class="mt-8 flex items-center justify-center">
                <span class="text-sm text-gray-600">{{ __('Belum mempunyai akun?') }}</span>
                <a class="ml-2 text-sm text-blue-600 hover:text-blue-900 font-medium" href="{{ route('register.siswa') }}">
                    {{ __('Daftar Siswa') }}
                </a>
            </div>
            
            <div class="mt-8 border-t border-gray-200 pt-6">
                <div class="flex justify-center items-center">
                    <span class="text-xs text-gray-500">&copy; {{ date('Y') }} Sistem Manajemen Prestasi Siswa. All rights reserved.</span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>