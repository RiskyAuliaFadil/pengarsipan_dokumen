<?php

namespace App\Filament\Resources;

use App\Filament\Exports\KtpExporter;
use App\Models\Ktp;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KtpResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KtpResource\RelationManagers;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;

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
                TextInput::make('nama_ktp')
                ->label('Nama')
                ->required(),
    
                TextInput::make('nik_ktp')
                ->numeric()
                ->label('NIK')
                ->required()
                ->minLength(16)
                ->maxLength(16)
                ->rule('digits:16') // validasi Laravel: harus 16 digit
                ->validationMessages([
                'digits' => 'NIK harus terdiri dari tepat 16 digit.',])
                ->unique(ignoreRecord: true), // ini penting saat edit
    
                Select::make('provinsi_id')
                ->label('Provinsi')
                ->options(\App\Models\Provinsi::all()->pluck('nama', 'id'))
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('kota_id', null))
                ->required(),
    
                Select::make('kota_id')
                ->label('Kota')
                ->options(function (callable $get) {
                    $provinsi = \App\Models\Provinsi::find($get('provinsi_id'));
                    return $provinsi ? $provinsi->kotas->pluck('nama', 'id') : [];
                })
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('kecamatan_id', null))
                ->required(),
    
                Select::make('kecamatan_id')
                ->label('Kecamatan')
                ->options(function (callable $get) {
                    $kota = \App\Models\Kota::find($get('kota_id'));
                    return $kota ? $kota->kecamatans->pluck('nama', 'id') : [];
                })
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('kelurahan_id', null))
                ->required(),
    
                Select::make('kelurahan_id')
                ->label('Kelurahan')
                ->options(function (callable $get) {
                    $kecamatan = \App\Models\Kecamatan::find($get('kecamatan_id'));
                    return $kecamatan ? $kecamatan->kelurahans->pluck('nama', 'id') : [];
                })
                ->reactive()
                ->required(),
    
                TextInput::make('alamat_ktp')
                ->label('Alamat')
                ->required(),
                FileUpload::make('arsip_ktp')
                ->label('Arsip Dokumen')
                ->disk('public')
                ->directory('arsip-ktp')
                ->image()
                ->required(),
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
                TextColumn::make('provinsi.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Provinsi'),
                TextColumn::make('kota.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Kota'),
                TextColumn::make('kecamatan.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Kecamatan'),
                TextColumn::make('kelurahan.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Kelurahan'),
                TextColumn::make('alamat_ktp')
                    ->searchable()
                    ->sortable()
                    ->label('Alamat'),
                ImageColumn::make('arsip_ktp')
                    ->width(100)
                    ->height(50)
                    ->label('Arsip Dokumen'),
            ])
            ->filters([
                SelectFilter::make('provinsi_id')
                    ->searchable()
                    ->label('Provinsi')
                    ->options(\App\Models\Provinsi::pluck('nama', 'id'))
                    ->placeholder('Filter Provinsi'),

                SelectFilter::make('kota_id')
                    ->searchable()
                    ->label('Kota')
                    ->options(\App\Models\Kota::pluck('nama', 'id'))
                    ->placeholder('Filter Kota'),

                SelectFilter::make('kecamatan_id')
                    ->searchable()
                    ->label('Kecamatan')
                    ->options(\App\Models\Kecamatan::pluck('nama', 'id'))
                    ->placeholder('Filter Kecamatan'),

                SelectFilter::make('kelurahan_id')
                    ->searchable()
                    ->label('Kelurahan')
                    ->options(\App\Models\Kelurahan::pluck('nama', 'id'))
                    ->placeholder('Filter Kelurahan'),
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
            // ->headerActions([
            //     ExportAction::make()->exporter(KtpExporter::class)
            // ])
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
