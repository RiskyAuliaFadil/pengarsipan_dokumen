<?php

namespace App\Filament\Resources;

use App\Models\Ktp;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KtpResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KtpResource\RelationManagers;

class KtpResource extends Resource
{
    protected static ?string $model = Ktp::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Document Management';

    protected static ?string $navigationLabel = 'Kelola Dokumen KTP';

    protected static ?string $slug = 'kelola-dokumen-ktp';

    public static ?string $label = 'Kelola Dokumen KTP';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_ktp'),
                TextInput::make('nik_ktp')
                    ->numeric(),
                TextInput::make('provinsi'),
                TextInput::make('kota'),
                TextInput::make('kecamatan'),
                TextInput::make('kelurahan'),
                TextInput::make('alamat_ktp'),
                FileUpload::make('arsip_ktp')
                    ->image()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_ktp')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Lengkap'),
                TextColumn::make('nik_ktp')
                    ->searchable()
                    ->sortable()
                    ->label('NIK'),
                TextColumn::make('provinsi')
                    ->searchable()
                    ->sortable()
                    ->label('Provinsi'),
                TextColumn::make('kota')
                    ->searchable()
                    ->sortable()
                    ->label('Kota'),
                TextColumn::make('kecamatan')
                    ->searchable()
                    ->sortable()
                    ->label('Kecamatan'),
                TextColumn::make('kelurahan')
                    ->searchable()
                    ->sortable()
                    ->label('Kelurahan'),
                TextColumn::make('alamat_ktp')
                    ->searchable()
                    ->sortable()
                    ->label('Alamat'),
                ImageColumn::make('arsip_ktp')
                    ->width(200)
                    ->height(100)
                    ->label('Arsip KTP'),
            ])
            ->filters([
            
            ])
            ->actions([
                
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => Storage::url($record->arsip_ktp))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->arsip_ktp !== null),

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
            'index' => Pages\ListKtps::route('/'),
            'create' => Pages\CreateKtp::route('/create'),
            'edit' => Pages\EditKtp::route('/{record}/edit'),
        ];
    }
}
