@extends('layouts.app')

@section('title', 'Detail Lokasi: ' . $project->nama_proyek)

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('reklame.map') }}" class="inline-flex items-center text-blue-500 hover:underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Peta
            </a>
        </div>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Layout Grid Utama (2 kolom di desktop, 1 kolom di mobile) --}}
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            {{-- Kolom Kiri (Informasi Detail) --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Kartu Informasi Utama --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $project->nama_proyek }}</h1>
                    <div class="mt-2">
                        <span class="inline-block bg-green-200 text-green-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                            Status: {{ $project->status }}
                        </span>
                    </div>
                </div>

                {{-- Kartu Deskripsi --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold flex items-center text-gray-900 dark:text-white">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Deskripsi Lokasi
                    </h2>
                    <p class="mt-4 text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $project->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            {{-- Kolom Kanan (Form Pengajuan) --}}
            <div class="mt-8 lg:mt-0">
                 @if($project->status !== 'Produksi')
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Ajukan Sewa Lokasi Ini</h2>
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            {{-- ... Sisa field form Anda ... --}}
                            <div class="mb-4">
                                <label for="nama_peminat" class="block font-medium mb-1">Nama Lengkap</label>
                                <input type="text" id="nama_peminat" name="nama_peminat" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700" required>
                            </div>
                            <div class="mb-4">
                                <label for="email_peminat" class="block font-medium mb-1">Alamat Email</label>
                                <input type="email" id="email_peminat" name="email_peminat" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700" required>
                            </div>
                            <div class="mb-4">
                                <label for="telepon_peminat" class="block font-medium mb-1">Nomor Telepon</label>
                                <input type="tel" id="telepon_peminat" name="telepon_peminat" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700" required>
                            </div>
                            <div class="mb-4">
                                <label for="pesan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Pesan (Opsional)</label>
                                <textarea id="pesan" name="pesan" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-600">Kirim Pengajuan</button>
                        </form>
                    </div>
                @else
                    <div class="bg-yellow-100 dark:bg-yellow-900/30 border-l-4 border-yellow-500 text-yellow-700 dark:text-yellow-300 p-4 rounded-lg" role="alert">
                        <p class="font-bold">Lokasi Tidak Tersedia</p>
                        <p>Lokasi ini sedang dalam masa sewa.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection