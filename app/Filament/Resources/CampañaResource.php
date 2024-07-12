<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampañaResource\Pages;
use App\Filament\Resources\CampañaResource\RelationManagers;
use App\Models\Campaña;
use App\Models\CD;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampañaResource extends Resource
{
    protected static ?string $model = Campaña::class;

    protected static ?string $navigationIcon = 'heroicon-c-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos de Campaña')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('cd.id')
                            ->label('CD')
                            ->required()
                            ->options(CD::all()->pluck('nombre', 'id'))
                            ->searchable(),
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('fecha_realizacion')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Evidencias de Campaña')
                    ->columns(4)
                    ->schema([
                        Forms\Components\FileUpload::make('evidencia')
                            ->label('Evidencia 1')
                            ->disk('public')
                            ->directory('evidencias')
                            ->image()
                            ->nullable()
                            ->hiddenOn('edit'),
                        Forms\Components\FileUpload::make('evidencia_1')
                            ->label('Evidencia 2')
                            ->disk('public')
                            ->directory('evidencias')
                            ->image()
                            ->nullable()
                            ->hiddenOn('edit'),
                        Forms\Components\FileUpload::make('evidencia_2')
                            ->label('Evidencia 3')
                            ->disk('public')
                            ->directory('evidencias')
                            ->image()
                            ->nullable()
                            ->hiddenOn('edit'),
                        Forms\Components\FileUpload::make('evidencia_3')
                            ->label('Evidencia 4')
                            ->disk('public')
                            ->directory('evidencias')
                            ->image()
                            ->nullable()
                            ->hiddenOn('edit'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cd_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_realizacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evidencia')
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
            'index' => Pages\ListCampañas::route('/'),
            'create' => Pages\CreateCampaña::route('/create'),
            'edit' => Pages\EditCampaña::route('/{record}/edit'),
        ];
    }
}
