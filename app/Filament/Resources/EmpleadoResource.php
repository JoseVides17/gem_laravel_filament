<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpleadoResource\Pages;
use App\Filament\Resources\EmpleadoResource\RelationManagers;
use App\Models\CD;
use App\Models\Empleado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpleadoResource extends Resource
{
    protected static ?string $model = Empleado::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';
    protected static ?string $navigationGroup = 'Gestion de empleados';
    protected static ?string $navigationLabel = 'Empleados';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Informacion Personal')
                    ->columns(3)
                ->schema([
                    Forms\Components\Select::make('cd_id')
                        ->label('CD')
                        ->required()
                        ->options(CD::all()->pluck('nombre', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make('cedula')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nombres')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('apellidos')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('fecha_nacimiento')
                        ->required(),
                    Forms\Components\Select::make('sexo')
                        ->label('Sexo')
                        ->required()
                        ->options([
                            'Masculino' => 'Masculino',
                            'Femenino' => 'Femenino',
                            'Sin_definir' => 'Sin Definir',
                            ])
                        ->searchable(),
                    Forms\Components\TextInput::make('edad')
                        ->required()
                        ->numeric(),
                    Forms\Components\FileUpload::make('foto_perfil')
                        ->label('Foto de Perfil')
                        ->disk('public')
                        ->directory('fotos_perfil')
                        ->image()
                        ->nullable()
                    ->hiddenOn('edit'),
                ]),
                Forms\Components\Section::make('Informacion Laboral')
                    ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('cargo')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('departamento')
                        ->label('Departamento')
                        ->required()
                        ->options([
                            'Administrativo' => 'Administrativo',
                            'Operativo' => 'Operativo',
                        ])
                        ->searchable(),
                ]),
                Forms\Components\Section::make('Informacion Adicional')
                    ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('eps')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('estado_civil')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('direccion')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('ciudad')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Toggle::make('estado')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cd.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cedula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto_perfil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('edad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cargo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('eps')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado_civil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ciudad')
                    ->searchable(),
                Tables\Columns\IconColumn::make('estado')
                    ->boolean(),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
        ];
    }
}
