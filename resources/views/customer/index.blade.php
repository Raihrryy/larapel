@extends('petugas.admin')

@section('header', 'Data Customer')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-sm border border-sage-100">
        
        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-sage-100 border border-sage-200 text-sage-900 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold text-sage-900">Daftar Customer Terdaftar</h2>
                <p class="text-sm text-gray-500 font-light mt-0.5">Kelola akun customer perpustakaan.</p>
            </div>
            <a href="{{ route('customer.create') }}" class="bg-sage-900 hover:bg-sage-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Tambah Customer
            </a>
        </div>
        
        <!-- Tabel Data Customer -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-sage-100 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-sage-50/50">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Password (Hash / Data)</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sage-100 text-sm text-gray-700">
                    @forelse($data_customer as $index => $customer)
                        <tr class="hover:bg-sage-50/50 transition-colors">
                            <td class="py-3 px-4">{{ $customer->id }}</td>
                            <td class="py-3 px-4 font-medium text-sage-900">{{ $customer->nama }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $customer->email }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <!-- Field teks password dengan tipe password/text yang di-toggle -->
                                    <input type="password" id="pw-{{ $index }}" value="{{ $customer->password }}" readonly class="bg-transparent border-none text-gray-500 text-xs w-48 focus:outline-none">
                                    
                                    <!-- Tombol Mata (Toggle) -->
                                    <button type="button" onclick="togglePassword({{ $index }})" class="text-gray-400 hover:text-sage-900 focus:outline-none" title="Tampilkan/Sembunyikan Password">
                                        <svg id="icon-{{ $index }}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <!-- Ikon Mata Tertutup (Default) -->
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                           <td class="py-3 px-4 text-center space-x-2">
    <!-- Hubungkan tombol edit ke route customer.edit dengan membawa ID customer -->
    <a href="{{ route('customer.edit', $customer->id) }}" class="text-sage-600 hover:text-sage-900 font-medium">Edit</a>
    <span class="text-gray-300">|</span>
    <a href="#" class="text-red-500 hover:text-red-700 font-medium">Hapus</a>
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400">Belum ada data customer.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script JavaScript untuk Toggle Password Nyala/Mati -->
    <script>
        function togglePassword(index) {
            const input = document.getElementById('pw-' + index);
            const icon = document.getElementById('icon-' + index);
            
            if (input.type === "password") {
                input.type = "text";
                // Ubah ikon jadi mata terbuka
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            } else {
                input.type = "password";
                // Kembalikan ke ikon mata tertutup
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            }
        }
    </script>
@endsection