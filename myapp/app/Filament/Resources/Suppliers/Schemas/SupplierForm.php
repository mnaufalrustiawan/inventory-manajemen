<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use App\Models\Supplier;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Supplier Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Supplier Name')
                            ->placeholder('e.g. PT. ABC, CV. XYZ')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->placeholder('e.g. john.doe@example.com')
                            ->email()
                            ->maxLength(255)
                            ->unique(Supplier::class, 'email', ignoreRecord: true),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->placeholder('e.g. +62 812 3456 7890')
                            ->tel()
                            ->maxLength(20),
                        Textarea::make('address')
                            ->label('Address')
                            ->placeholder('e.g. Jl. Raya No. 123, Jakarta')
                            ->rows(3)
                            ->columnSpanFull(),
                        Toggle::make('status')
                            ->label('Active Status')
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull()
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
