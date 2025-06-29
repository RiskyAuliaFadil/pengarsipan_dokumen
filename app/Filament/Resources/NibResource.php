<?php

namespace App\Filament\Resources;

use App\Models\Nib;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NibResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NibResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;

class NibResource extends Resource
{
    protected static ?string $model = Nib::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Document Management';

    protected static ?string $navigationLabel = 'Kelola Dokumen NIB';

    protected static ?string $slug = 'kelola-dokumen-nib';

    public static ?string $label = 'Kelola Dokumen NIB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_nib')
                ->required()
                ->label('Nama'),

                TextInput::make('no_nib')
                ->label('Nomor Induk Berusaha')
                    ->required()
                    ->numeric()
                    ->maxLength(20),
                // TextInput::make('kode_kbli')
                //     ->required()
                //     ->maxLength(6)
                //     ->numeric(),
                Select::make('kbli_id')
                    ->relationship('kbli', 'nama') // 'kbli' sesuai dengan nama method relasi di model
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('alamat_nib')
                ->required()
                ->label('Alamat'),
                FileUpload::make('arsip_nib')
                ->label('Arsip Dokumen')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->downloadable()
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_nib')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_nib')
                    ->searchable()
                    ->sortable()
                    ->label('Nomer NIB'),
                TextColumn::make('kbli.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Kode KBLI'),
                TextColumn::make('alamat_nib')
                    ->searchable()
                    ->sortable()
                    ->label('Alamat'),
                TextColumn::make('arsip_nib')
                    ->label('Arsip Dokumen')
                   
            ])
            ->filters([
                SelectFilter::make('kbli')
                    ->relationship('kbli', 'nama')
                    ->label('Kode KBLI')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => Storage::url($record->arsip_nib))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->arsip_nib !== null),
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
            'index' => Pages\ListNibs::route('/'),
            'create' => Pages\CreateNib::route('/create'),
            'edit' => Pages\EditNib::route('/{record}/edit'),
        ];
    }
}
