<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jasa Reklame')</title>
    
    {{-- Memuat CSS utama dari Vite --}}
    @vite('resources/css/app.css')

    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    {{-- Slot untuk CSS tambahan dari halaman lain --}}
    @stack('styles')
</head>
<body class="bg-slate-100 dark:bg-slate-900 text-slate-800 dark:text-slate-200">

    {{-- Navigasi atau Header bisa diletakkan di sini nanti --}}

    <main class="container mx-auto py-8">
        {{-- Slot untuk konten utama halaman --}}
        @yield('content')
    </main>

    {{-- Slot untuk JavaScript tambahan dari halaman lain --}}
    @stack('scripts')
</body>
</html>