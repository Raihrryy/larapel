@extends('admin.layout')

@section('header', 'Edit Jadwal & Data Petugas')

@section('content')
    <div class="max-w-xl bg-white p-8 rounded-xl shadow-sm border border-sage-100">
        <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Petugas</label>
                <input type="text" name="nama" value="{{ old('nama', $petugas->nama) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Petugas</label>
                <input type="email" name="email" value="{{ old('email', $petugas->email) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Shift</label>
                    <select name="shift" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                        <option value="Pagi (07:00 - 12:00)" {{ $petugas->shift == 'Pagi (07:00 - 12:00)' ? 'selected' : '' }}>Pagi (07:00 - 12:00)</option>
                        <option value="Siang (12:00 - 17:00)" {{ $petugas->shift == 'Siang (12:00 - 17:00)' ? 'selected' : '' }}>Siang (12:00 - 17:00)</option>
                        <option value="Full Day" {{ $petugas->shift == 'Full Day' ? 'selected' : '' }}>Full Day</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Tugas</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
                        <option value="Bertugas" {{ $petugas->status == 'Bertugas' ? 'selected' : '' }}>Bertugas</option>
                        <option value="Libur" {{ $petugas->status == 'Libur' ? 'selected' : '' }}>Libur</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru <span class="text-gray-400 font-normal">(Kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sage-500 focus:outline-none">
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.petugas.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 bg-sage-900 hover:bg-sage-600 text-white rounded-lg text-sm font-medium transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection