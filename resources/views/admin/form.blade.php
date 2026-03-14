<x-app-layout title="Form Admin">

    <x-slot name="heading">
        {{ $page_meta['title'] }}
    </x-slot>

    <x-slot name="body">
        <div class="flex items-center gap-3 ml-6">
            <form action="{{ $page_meta['url'] }}" method="POST" class="space-y-6">
                @csrf
                @method($page_meta['method'])

                {{-- Nama Admin --}}
                <div>
                    <label for="name" class="block font-medium mb-1">Nama Admin</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $admin->name) }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email / Username --}}
                <div>
                    <label for="email" class="block font-medium mb-1">Username / Email</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $admin->email) }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border rounded px-3 py-2"
                        {{ $page_meta['method'] == 'POST' ? 'required' : '' }}>
                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    @if($page_meta['method'] != 'POST')
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti password.</p>
                    @endif
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        {{ $page_meta['button'] }}
                    </button>
                </div>

            </form>
        </div>
    </x-slot>

</x-app-layout>