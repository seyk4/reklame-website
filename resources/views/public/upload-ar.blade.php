@extends('layouts.app')

@section('title', 'Upload Desain AR')

@section('content')
<div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md max-w-xl mx-auto text-center">
    <h1 class="text-2xl font-bold mb-4">1. Upload Desain Reklame Anda</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-6">Pilih file gambar (JPG atau PNG) yang ingin Anda visualisasikan dalam Augmented Reality.</p>

    {{-- BAGIAN UPLOAD YANG DIPERBARUI --}}
    <div class="mt-4 flex justify-center">
        {{-- 1. Struktur disederhanakan untuk centering yang lebih baik --}}
        <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:hover:border-gray-500">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5"></p>
            <svg class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
            <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span></p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">JPG atau PNG</p>
            <input id="image-upload" type="file" class="hidden" accept="image/png, image/jpeg" />
        </label>
    </div>
    
    <div id="message-container" class="mt-4 font-bold" style="min-height: 24px;"></div>
    
    {{-- 2. Warna tombol disesuaikan untuk dark mode --}}
    <a href="{{ route('reklame.ar.viewer') }}" id="start-button" class="mt-6 inline-flex items-center justify-center bg-blue-600 dark:bg-primary-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg pointer-events-none opacity-50 hover:bg-blue-500 dark:hover:bg-primary-500 transition-transform transform hover:scale-105" style="display: none;">
        Lanjutkan ke Tampilan AR
    </a>
</div>

@push('scripts')
<script>
    const imageUpload = document.querySelector('#image-upload');
    const startButton = document.querySelector('#start-button');
    const messageContainer = document.querySelector('#message-container');

    imageUpload.addEventListener('change', (event) => {
        startButton.style.display = 'none';
        startButton.classList.add('opacity-50', 'pointer-events-none');
        messageContainer.textContent = '';
        messageContainer.classList.remove('text-green-600', 'text-red-600');

        const file = event.target.files[0];
        if (!file) {
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            messageContainer.textContent = 'Error: Format file harus JPG atau PNG.';
            messageContainer.classList.add('text-red-600');
            imageUpload.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            sessionStorage.setItem('arImage', e.target.result);
            messageContainer.innerHTML = `✅ Gambar berhasil dipilih: <span class="italic">${file.name}</span>`;
            messageContainer.classList.add('text-green-600');
            startButton.style.display = 'inline-flex';
            startButton.classList.remove('opacity-50', 'pointer-events-none');
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
@endsection