<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Surat;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuratResource\RelationManagers;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Document Management';

    protected static ?string $navigationLabel = 'Kelola Dokumen Surat';

    protected static ?string $slug = 'kelola-dokumen-surat';

    public static ?string $label = 'Kelola Dokumen Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('no_surat')
                    ->required(),
                DatePicker::make('tgl_surat')
                    ->required(),
                TextInput::make('perihal')
                    ->required(),
                TextInput::make('pengirim')
                    ->required(),
                FileUpload::make('arsip_surat')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_surat')
                    ->label('No Surat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tgl_surat')
                    ->searchable()
                    ->label('Tanggal')
                    ->sortable(),
                TextColumn::make('perihal')
                    ->searchable()
                    ->label('Perihal')
                    ->sortable(),
                TextColumn::make('pengirim')
                    ->searchable()
                    ->label('Pengirim')
                    ->sortable(),
                TextColumn::make('arsip_surat')
                    ->searchable()
                    ->label('Arsip Dokumen')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => Storage::url($record->arsip_surat))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->arsip_surat !== null),
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
