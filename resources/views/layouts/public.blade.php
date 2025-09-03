<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Reklame')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex">
        <div class="w-64 h-screen bg-gray-800 p-5">
            <h1 class="text-2xl font-bold mb-10">Jasa Reklame</h1>
            <nav>
                <a href="{{ route('clients.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Manajemen Klien</a>
                {{-- Link untuk menu lain bisa ditambahkan di sini --}}
            </nav>
        </div>

        <div class="flex-1 p-10">
            <h2 class="text-3xl font-bold mb-6">@yield('page-title')</h2>
            
            {{-- Konten dinamis akan dimuat di sini --}}
            @yield('content')
        </div>
    </div>

</body>
</html>