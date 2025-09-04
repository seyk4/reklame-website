<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Project; // Import model Project
use App\Filament\Resources\ProjectResource; // Import ProjectResource

class Peta extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Peta Reklame';
    protected static string $view = 'filament.pages.peta';

    // Properti publik untuk menyimpan data lokasi
    public array $locations = [];

    // Method ini berjalan saat halaman pertama kali dimuat
    public function mount(): void
    {
        $projects = Project::whereNotNull('latitude')->whereNotNull('longitude')->get();
        
        // Kita format data agar mudah digunakan oleh JavaScript
        $this->locations = $projects->map(fn (Project $project) => [
            'nama_proyek' => $project->nama_proyek,
            'latitude' => $project->latitude,
            'longitude' => $project->longitude,
            'status' => $project->status,
            // Membuat URL ke halaman edit proyek di admin panel
            'admin_url' => ProjectResource::getUrl('edit', ['record' => $project]),
        ])->all();
    }
}