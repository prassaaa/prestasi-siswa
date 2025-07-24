<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-36 w-auto">
            </div>
            
            <!-- Judul -->
            <div class="flex justify-center mb-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900 font-sans">
                        <a href="/" class="hover:text-blue-600 transition duration-300">
                            Registrasi Akun Siswa Baru
                        </a>
                    </h1>
                    <p class="text-sm text-gray-600 mt-2">Silahkan untuk melengkapi data siswa</p>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register.siswa.store') }}">
                @csrf

                <!-- NISN -->
                <div class="mb-6">
                    <x-input-label for="nisn" :value="__('NISN')" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5 5 0 0010 2z" />
                            </svg>
                        </div>
                        <x-text-input id="nisn" class="block mt-1 w-full pl-10" type="text" name="nisn" :value="old('nisn')" required autofocus placeholder="Masukkan NISN" />
                    </div>
                    <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                </div>

                <!-- Nama -->
                <div class="mb-6">
                    <x-input-label for="nama" :value="__('Nama Lengkap')" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="nama" class="block mt-1 w-full pl-10" type="text" name="nama" :value="old('nama')" required placeholder="Masukkan Nama Lengkap" />
                    </div>
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required placeholder="nama@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="tingkat" :value="__('Tingkat Sekolah')" />
                    <select id="tingkat" name="tingkat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pl-10" required>
                        <option value="">-- Pilih Tingkat Sekolah --</option>
                        <option value="TK" {{ old('tingkat') == 'TK' ? 'selected' : '' }}>TK</option>
                        <option value="SD" {{ old('tingkat') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ old('tingkat') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('tingkat') == 'SMA' ? 'selected' : '' }}>SMA</option>
                    </select>
                    <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
                </div>

                <!-- Sekolah -->
                <div class="mb-6">
                    <x-input-label for="sekolah_id" :value="__('Sekolah')" />
                    <select id="sekolah_id" name="sekolah_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pl-10" required>
                        <option value="">-- Pilih Sekolah --</option>
                        @foreach($sekolah as $item)
                            <option value="{{ $item->id }}" {{ old('sekolah_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_sekolah }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('sekolah_id')" class="mt-2" />
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-6">
                    <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                    <x-text-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir')" placeholder="Masukkan Tempat Lahir" />
                    <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-6">
                    <x-input-label for="tanggal" :value="__('Tanggal Lahir')" />
                    <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal')" />
                    <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                </div>

                <!-- Alamat -->
                <div class="mb-6">
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <!-- No HP -->
                <div class="mb-6">
                    <x-input-label for="no_hp" :value="__('No. HP')" />
                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" placeholder="Masukkan No. HP" />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
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
                        <x-text-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10" type="password" name="password_confirmation" required placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Tombol Daftar -->
                <div class="flex items-center justify-center mt-8">
                    <x-primary-button class="w-full flex justify-center py-3 bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out hover:scale-105">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>

                <!-- Link Login -->
                <div class="mt-6 flex items-center justify-center">
                    <span class="text-sm text-gray-600">{{ __('Sudah terdaftar?') }}</span>
                    <a class="ml-2 text-sm text-blue-600 hover:text-blue-900 font-medium" href="{{ route('login') }}">
                        {{ __('Masuk di sini') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>