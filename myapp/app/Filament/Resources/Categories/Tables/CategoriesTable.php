<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Category Name')
                    ->searchable()
                    ->sortable(),
                TextCloumn::make('parent.name')
                    ->label('Parent Category')
                    ->default('-')
                    ->searchable()
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggleHiddenByDefault: false),
                TextColumn::make('children_count')
                    ->label('Subcategory')
                    -.counts('children')
                    ->badge()
                    ->color('info'),
                IconColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger'),
                    // ->boolean(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'active',
                        '2' => 'inactive',
                    ])
                SelectFilter::make('parent_id')
                    ->label('Parent Category')
                    ->options(
                        Category::whereNull('parent_id')
                            ->pluck('name','id')
                    )
                    ->placeholder('All Categories'),
            ])
            ->Actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
            ->defaultSort('created_at', 'desc');
    }
}
