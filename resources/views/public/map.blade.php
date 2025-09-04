@extends('layouts.app') {{-- Menggunakan layout publik Anda --}}

@section('title', 'Peta Lokasi Reklame')

{{-- Sisipkan CSS Leaflet di <head> --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height: 600px; } /* Atur tinggi peta */
    </style>
@endpush

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Peta Lokasi Reklame</h1>
        <div id="map"></div>
    </div>
@endsection

{{-- Sisipkan JS Leaflet sebelum penutup </body> --}}
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Inisialisasi Peta
        // Ganti koordinat setView dengan titik tengah lokasi Anda, misal Jakarta
        const map = L.map('map').setView([-6.31385718189073, 106.82834076457164], 10);

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Ambil data lokasi dari controller
        const locations = @json($locations);

        // Tambahkan marker untuk setiap lokasi
        locations.forEach(location => {
            L.marker([location.latitude, location.longitude])
                .addTo(map)
                .bindPopup(
                    `<b>${location.nama_proyek}</b><br>Status: ${location.status}<br><br>` +
                    `<a href="/reklame/${location.id}" class="text-blue-500 font-bold hover:underline">Lihat Detail &rarr;</a>`
                );
        });
    </script>
@endpush