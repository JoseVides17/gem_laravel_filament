<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoExamenResource\Pages;
use App\Filament\Resources\TipoExamenResource\RelationManagers;
use App\Models\TipoExamen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoExamenResource extends Resource
{
    protected static ?string $model = TipoExamen::class;

    protected static ?string $label = 'Tipos de Examenes';

    protected static ?string $navigationIcon = 'heroicon-c-queue-list';
    protected static ?string $navigationLabel = 'Tipos de Examenes';
    protected static ?string $navigationGroup = 'Sistema';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
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
            'index' => Pages\ListTipoExamens::route('/'),
            'create' => Pages\CreateTipoExamen::route('/create'),
            'edit' => Pages\EditTipoExamen::route('/{record}/edit'),
        ];
    }
}
