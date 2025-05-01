<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Kota;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KotaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KotaResource\RelationManagers;

class KotaResource extends Resource
{
    protected static ?string $model = Kota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?string $navigationLabel = 'Kelola Kota';

    protected static ?string $slug = 'kelola-kota';

    public static ?string $label = 'Kelola Kota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('provinsi_id')
                    ->relationship('provinsis', 'nama')
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
                    ->label('Nama Kota'),
                TextColumn::make('provinsi.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Provinsi'),
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
            'index' => Pages\ListKotas::route('/'),
            'create' => Pages\CreateKota::route('/create'),
            'edit' => Pages\EditKota::route('/{record}/edit'),
        ];
    }
}
