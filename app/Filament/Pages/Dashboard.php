<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview; // Import widget Anda
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    public function getWidgets(): array
    {
        return [
            // Daftarkan widget Anda di sini
            StatsOverview::class,
        ];
    }
}