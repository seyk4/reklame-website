<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Project;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $projectStats = Project::select('status', DB::raw('count(*) as count'))
                               ->groupBy('status')
                               ->pluck('count', 'status');
        return [
            // Kartu Statistik #1: Total Klien dan Proyek
            Stat::make('Total Klien', Client::count())
                ->description('Total Proyek: ' . Project::count())
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary'),

            // Kartu Statistik #2: Proyek yang Sedang Aktif
            Stat::make('Proyek Aktif', Project::where('status', 'Produksi')->count())
                ->description('Proyek dalam tahap produksi')
                ->descriptionIcon('heroicon-m-arrow-path', 'before')
                ->color('warning'),

            // Kartu Statistik #3: Proyek yang Telah Selesai
            Stat::make('Proyek Selesai', Project::where('status', 'Selesai')->count())
                ->description('Proyek yang telah selesai dikerjakan')
                ->descriptionIcon('heroicon-m-check-badge', 'before')
                ->color('success'),
        ];
    }
}