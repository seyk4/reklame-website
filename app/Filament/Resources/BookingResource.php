<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use App\Filament\Pages\Peta;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('lokasi_reklame')
                    ->label('Lokasi Reklame')
                    ->content(function ($record): ?HtmlString {
                        if (!$record || !$project = $record->project) {
                            return null;
                        }

                        // Ganti 'route(...)' dengan 'Peta::getUrl(...)'
                        $url = Peta::getUrl([
                            'lat' => $project->latitude,
                            'lng' => $project->longitude,
                            'zoom' => 17,
                        ]);

                        return new HtmlString('<a href="' . $url . '" target="_blank" class="hover:underline font-medium">' . $project->nama_proyek . '</a>');
                    }),
            
                TextInput::make('nama_peminat')->disabled(),
                TextInput::make('email_peminat')->email()->disabled(),
                TextInput::make('telepon_peminat')->tel()->disabled(),
                Textarea::make('pesan')->columnSpanFull()->disabled(),

                Select::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Dihubungi' => 'Dihubungi',
                        'Deal' => 'Deal',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->required()
                    ->disablePlaceholderSelection()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.nama_proyek')->label('Lokasi')->sortable()->searchable(),
                TextColumn::make('nama_peminat')->searchable(),
                TextColumn::make('telepon_peminat'),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Baru',
                        'warning' => 'Dihubungi',
                        'success' => 'Deal',
                        'danger' => 'Ditolak',
                    ]),
                TextColumn::make('created_at')->dateTime()->label('Tanggal Masuk')->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Tampilkan pengajuan terbaru di atas
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
