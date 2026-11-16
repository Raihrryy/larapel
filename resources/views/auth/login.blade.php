<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Library.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        sage: { 50: '#f8faf7', 100: '#eef2ec', 200: '#dce5d8', 500: '#7a9c76', 600: '#5e7d5a', 900: '#2c3e29' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sage-50 font-sans text-gray-800 antialiased min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-sage-100">
        <div class="text-center mb-8">
            <a href="{{ route('pengunjung.index') }}" class="text-3xl font-serif font-bold text-sage-900 tracking-tight">
                Library<span class="text-sage-500">.</span>
            </a>
            <p class="text-sm text-gray-500 mt-2">Masuk ke Panel Administrator</p>
        </div>

        @if($errors->any())
            <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Admin</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@library.com"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sage-500 focus:outline-none text-sm">
            </div>

            <button type="submit" class="w-full py-2.5 bg-sage-900 hover:bg-sage-600 text-white rounded-xl text-sm font-medium transition-colors">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('pengunjung.index') }}" class="text-xs text-gray-400 hover:text-sage-900 transition-colors">
                ← Kembali ke Halaman Pengunjung
            </a>
        </div>
    </div>

</body>
</html>