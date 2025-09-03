<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

// Import komponen UI yang akan kita gunakan
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_proyek')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                
                // Dropdown untuk Status
                Select::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Produksi' => 'Produksi',
                        'Selesai' => 'Selesai',
                    ])
                    ->default('Baru') // Nilai default saat membuat proyek baru dari sini
                    ->required(),
                
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_proyek')
            ->columns([
                TextColumn::make('nama_proyek'),
                
                // Menampilkan status dengan badge berwarna
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Baru',
                        'warning' => 'Produksi',
                        'success' => 'Selesai',
                    ]),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal Dibuat'), // Mengubah label kolom
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}