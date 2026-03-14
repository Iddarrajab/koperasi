<x-app-layout title="Login">
    <x-slot name="heading">
        Login
    </x-slot>

    <x-slot name="body">
        <div class="flex flex-col w-full max-w-md mx-auto gap-3 px-4">


            {{-- ERROR GLOBAL (misal: akun belum diverifikasi) --}}
            @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ $errors->first() }}
            </div>
            @endif

            {{-- ERROR SESSION (opsional) --}}
            @if(session('error'))
            <p class="text-sm text-red-600 mb-4">
                {{ session('error') }}
            </p>
            @endif

            <form action="{{ route('login') }}" method="POST" class="mt-6">
                @csrf

                {{-- Email --}}
                <label for="email" class="block font-medium mb-1">
                    Email:
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="border rounded px-2 py-1 w-full mb-1"
                    placeholder="Masukkan email"
                    required>

                @error('email')
                <p class="text-sm text-red-600 mb-3">
                    {{ $message }}
                </p>
                @enderror

                {{-- Password --}}
                <label for="password" class="block font-medium mb-1">
                    Password:
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="border rounded px-2 py-1 w-full mb-1"
                    placeholder="Masukkan password"
                    required>

                @error('password')
                <p class="text-sm text-red-600 mb-3">
                    {{ $message }}
                </p>
                @enderror

                {{-- Button Login --}}
                <button
                    type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Login
                </button>
            </form>

            {{-- Divider --}}
            <div class="my-6 flex items-center">
                <div class="flex-grow border-t"></div>
                <span class="mx-4 text-gray-500 text-sm">atau</span>
                <div class="flex-grow border-t"></div>
            </div>

            {{-- Tombol Registrasi Anggota --}}
            <a
                href="{{ route('anggota.daftar') }}"
                class="block w-full text-center bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Daftar sebagai Anggota
            </a>
        </div>

    </x-slot>
</x-app-layout>