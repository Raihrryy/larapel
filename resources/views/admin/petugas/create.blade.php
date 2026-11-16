@extends('admin.layout')

@section('header', 'Tambah Petugas Baru')

@section('content')
    <div class="max-w-xl bg-white p-8 rounded-xl shadow-sm border border-sage-100">
        <form action="{{ route('admin.petugas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Petugas</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Petugas</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Shift</label>
                    <select name="shift" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                        <option value="Pagi (07:00 - 12:00)">Pagi (07:00 - 12:00)</option>
                        <option value="Siang (12:00 - 17:00)">Siang (12:00 - 17:00)</option>
                        <option value="Full Day">Full Day</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Tugas</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                        <option value="Bertugas">Bertugas</option>
                        <option value="Libur">Libur</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Akun Petugas</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.petugas.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 bg-sage-900 hover:bg-sage-600 text-white rounded-lg text-sm font-medium transition-colors">
                    Simpan Petugas
                </button>
            </div>
        </form>
    </div>
@endsection