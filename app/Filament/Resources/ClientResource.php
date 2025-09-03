<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

// Import komponen-komponen UI yang akan kita gunakan
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group'; // Ikon untuk di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Ini adalah "terjemahan" dari form di create.blade.php
                TextInput::make('nama_klien')
                    ->label('Nama Klien') // Label yang tampil di form
                    ->required() // Validasi: wajib diisi
                    ->maxLength(255), // Validasi: maksimal 255 karakter

                TextInput::make('kontak_person')
                    ->label('Kontak Person')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nomor_telepon')
                    ->label('Nomor Telepon')
                    ->tel() // Memberi tahu browser ini input nomor telepon
                    ->required()
                    ->maxLength(20),

                Textarea::make('alamat')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(), // Membuat field ini selebar form
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Ini adalah "terjemahan" dari tabel di index.blade.php
                TextColumn::make('id')
                    ->sortable(), // Membuat kolom ini bisa di-sort

                TextColumn::make('nama_klien')
                    ->searchable(), // Membuat kolom ini bisa dicari

                TextColumn::make('kontak_person')
                    ->searchable(),

                TextColumn::make('nomor_telepon'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Kolom ini bisa disembunyikan
            ])
            ->filters([
                // Filter bisa ditambahkan di sini nanti
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

    public static function getRelations(): array
    {
        return [
            // Relasi bisa ditambahkan di sini
            RelationManagers\ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}