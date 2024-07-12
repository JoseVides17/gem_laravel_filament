<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CDResource\Pages;
use App\Filament\Resources\CDResource\RelationManagers;
use App\Models\CD;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CDResource extends Resource
{
    protected static ?string $model = CD::class;

    protected static ?string $label = 'Centros de Distribucion';

    protected static ?string $navigationIcon = 'heroicon-s-building-storefront';
    protected static ?string $navigationLabel = 'Centro de Distribucion';
    protected static ?string $navigationGroup = 'Sistema';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ubicacion')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ubicacion')
                    ->searchable(),
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
            'index' => Pages\ListCDS::route('/'),
            'create' => Pages\CreateCD::route('/create'),
            'edit' => Pages\EditCD::route('/{record}/edit'),
        ];
    }
}
