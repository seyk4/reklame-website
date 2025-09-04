<x-filament-panels::page>
    {{-- Sisipkan CSS Leaflet --}}
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            #adminMap { height: 60vh; border-radius: 0.5rem; z-index: 0; }
        </style>
    @endpush

    <x-filament::section>
        <div id="adminMap"></div>
    </x-filament::section>
    
    {{-- Sisipkan JS Leaflet & script kustom --}}
    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Ambil parameter dari URL
                const urlParams = new URLSearchParams(window.location.search);
                const lat = urlParams.get('lat');
                const lng = urlParams.get('lng');
                const zoom = urlParams.get('zoom');

                // Tentukan titik tengah dan level zoom
                // Jika ada parameter, gunakan itu. Jika tidak, gunakan nilai default.
                const mapCenter = [lat || -6.31385718189073, lng || 106.82834076457164];
                const mapZoom = zoom || 10;

                // Inisialisasi Peta
                const map = L.map('adminMap').setView(mapCenter, mapZoom);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                // Ambil data lokasi dari properti publik
                const locations = @json($this->locations);

                // Tambahkan marker untuk setiap lokasi
                locations.forEach(location => {
                    L.marker([location.latitude, location.longitude])
                        .addTo(map)
                        .bindPopup(
                            `<b>${location.nama_proyek}</b><br>Status: ${location.status}<br><br>` +
                            `<a href="${location.admin_url}" class="font-bold text-primary-600 hover:underline">Buka Detail Proyek &rarr;</a>`
                        );
                });
            });
        </script>
    @endpush
</x-filament-panels::page>