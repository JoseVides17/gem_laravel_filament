<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Registrar Team';
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
            ]);
    }

    public function handleRegistration(array $data): Team
    {
        $team = Team::create($data);
        $team->members()->attach(auth()->user());
        return $team;
    }
}
