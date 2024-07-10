<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamenResource\Pages;
use App\Filament\Resources\ExamenResource\RelationManagers;
use App\Models\Empleado;
use App\Models\Examen;
use App\Models\TipoExamen;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Laravel\Prompts\select;

class ExamenResource extends Resource
{
    protected static ?string $model = Examen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Gestion de Examenes";
    protected static ?string $navigationLabel = 'Examenes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informacion del Empleado')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('empleado_id')
                            ->label('Cedula')
                            ->required()
                            ->options(Empleado::all()->pluck('cedula', 'id'))
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $empleado = Empleado::find($state);
                                $set('nombre_empleado', $empleado ? $empleado->nombres .' '. $empleado->apellidos: '');
                            }),
                        Forms\Components\TextInput::make('nombre_empleado')
                            ->label('Nombre del Empleado')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('lesion')
                            ->label('Lesion')
                            ->required()
                            ->options([
                                'Si' => 'Si',
                                'No' => 'No',
                            ]),
                        Forms\Components\TextInput::make('peso')
                            ->required()
                            ->reactive()
                            ->numeric()
                            ->afterStateUpdated(function ($state, callable $set, callable $get){
                                $talla = $get('talla')/100;
                                if ($talla && $talla != 0) {
                                    $imc = $state / ($talla * $talla);
                                    $set('imc', $imc);
                                    if ($imc >= 30)
                                        $interpretacion = 'Obesidad';
                                    if ($imc < 30 && $imc >= 25)
                                        $interpretacion = 'Moderado';
                                    if ($imc < 25 && $imc >= 18.5)
                                        $interpretacion = 'Peso Normal';
                                    if ($imc < 18.5)
                                        $interpretacion = 'Delgadez';
                                    $set('interpretacion', $interpretacion);
                                }
                            }),
                        Forms\Components\TextInput::make('talla')
                            ->required()
                            ->reactive()
                            ->numeric()
                            ->alphaNum()
                            ->afterStateUpdated(function ($state, callable $set, callable $get){
                                $peso = $get('peso');
                                if ($peso && $peso != 0) {
                                    $mt = $state/100;
                                    $imc = $peso / ($mt * $mt);
                                    $set('imc', $imc);
                                    if ($imc >= 30)
                                        $interpretacion = 'Obesidad';
                                    if ($imc < 30 && $imc >= 25)
                                        $interpretacion = 'Moderado';
                                    if ($imc < 25 && $imc >= 18.5)
                                        $interpretacion = 'Peso Normal';
                                    if ($imc < 18.5)
                                        $interpretacion = 'Delgadez';
                                    $set('interpretacion', $interpretacion);
                                }
                            }),
                        Forms\Components\TextInput::make('imc')
                            ->reactive()
                            ->numeric(),
                        Forms\Components\TextInput::make('interpretacion')
                            ->maxLength(255)
                            ->reactive(),
                        Forms\Components\Select::make('fuma')
                            ->label('Fuma')
                            ->required()
                            ->options([
                                'No',
                                'Si',
                            ]),
                        Forms\Components\Select::make('psicoactivos')
                            ->label('Psicoactivos')
                            ->required()
                            ->options([
                                'No',
                                'Si',
                            ]),
                        Forms\Components\Select::make('actividad_fisica')
                            ->label('Actividad Fisica')
                            ->required()
                            ->options([
                                'No',
                                'Si',
                            ]),
                        Forms\Components\Select::make('consumo')
                            ->label('Consumo')
                            ->required()
                            ->options([
                                'No' => 'No',
                                'Si' => 'Si',
                            ]),
                        Forms\Components\Select::make('CIG_DIA')
                            ->label('CIG_DIA')
                            ->required()
                            ->options([
                                'No' => 'No',
                                'Si' => 'Si',
                            ]),
                        Forms\Components\TextInput::make('tipo_actividad_fisica')
                            ->label('Tipo de Actividad Fisica')
                            ->required()
                    ]),
                Forms\Components\Section::make('Informacion del Examen')
                    ->columns(3)
                    ->schema([
                        Forms\Components\DatePicker::make('fecha_previa')
                            ->required(),
                        Forms\Components\DatePicker::make('fecha_realizacion')
                            ->required(),
                        Forms\Components\DatePicker::make('fecha_vencimiento')
                            ->required()
                            ->reactive()
                        ->afterStateUpdated(function ($state, callable $set, callable $get){
                            $fechaActual = new \DateTime();
                            $fechaVence = new \DateTime($get('fecha_vencimiento'));
                            $diferencia = $fechaActual->diff($fechaVence);
                            $diasDisponibles = $diferencia->days;
                            $set('dias_disponibles', $diasDisponibles);
                        }),
                        Forms\Components\TextInput::make('dias_disponibles')
                        ->reactive(),
                        Forms\Components\Select::make('tipo_examen_id')
                            ->label('Tipo de Examen')
                            ->required()
                            ->options(TipoExamen::all()->pluck('nombre', 'id'))
                            ->searchable(),
                        Forms\Components\TextInput::make('valoracion')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('restricciones')
                            ->maxLength(255),
                        Forms\Components\Select::make('estatus')
                            ->required()
                        ->options([
                            'Vigente' => 'Vigente',
                            'Anulado' => 'Anulado',
                        ]),
                        Forms\Components\TextInput::make('enfasis')
                        ->required()
                    ]),
                Forms\Components\Section::make('Recomendaciones')
                    ->schema([
                        Forms\Components\Textarea::make('recomendacion_general')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('recomendacion_ocupacional')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('recomendacion_medica')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('seguimiento')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('empleado.cedula')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre_empleado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_previa')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_realizacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_vencimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipoExamen.nombre')
                    ->label('Tipo de examen')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dias_disponibles')
                    ->numeric(),
                Tables\Columns\TextColumn::make('estatus')
                    ->searchable(),
                Tables\Columns\TextColumn::make('enfasis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lesion')
                    ->searchable(),
                Tables\Columns\IconColumn::make('fuma')
                    ->boolean(),
                Tables\Columns\TextColumn::make('CIG_DIA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('consumo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('psicoactivos')
                    ->boolean(),
                Tables\Columns\IconColumn::make('actividad_fisica')
                    ->boolean(),
                Tables\Columns\TextColumn::make('tipo_actividad_fisica')
                    ->searchable(),
                Tables\Columns\TextColumn::make('peso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('talla')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('imc')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interpretacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valoracion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('restricciones')
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListExamens::route('/'),
            'create' => Pages\CreateExamen::route('/create'),
            'edit' => Pages\EditExamen::route('/{record}/edit'),
        ];
    }
}
