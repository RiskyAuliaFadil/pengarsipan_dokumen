<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kecamatan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KecamatanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KecamatanResource\RelationManagers;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?string $navigationLabel = 'Kelola Kecamatan';

    protected static ?string $slug = 'kelola-kecamatan';

    public static ?string $label = 'Kelola Kecamatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->required(),

                TextInput::make('nama')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Kecamatan'),
                TextColumn::make('kota.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Kota'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListKecamatans::route('/'),
            'create' => Pages\CreateKecamatan::route('/create'),
            'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }
}
