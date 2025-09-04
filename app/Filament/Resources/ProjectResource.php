<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_proyek')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Select dropdown untuk memilih Klien
                Select::make('client_id')
                    ->relationship('client', 'nama_klien') // Ambil data dari relasi 'client' dan tampilkan field 'nama_klien'
                    ->searchable() // Agar bisa dicari
                    ->required(),

                // Select dropdown untuk Status
                Select::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Produksi' => 'Produksi',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(),

                TextInput::make('latitude')
                    ->numeric()
                    ->nullable(),

                TextInput::make('longitude')
                    ->numeric()
                    ->nullable(),

                Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_proyek')
                    ->searchable(),

                // Menampilkan nama klien, bukan ID-nya
                TextColumn::make('client.nama_klien')
                    ->sortable()
                    ->searchable(),

                // Menampilkan status dengan badge berwarna
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Baru',
                        'warning' => 'Produksi',
                        'success' => 'Selesai',
                    ]),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
