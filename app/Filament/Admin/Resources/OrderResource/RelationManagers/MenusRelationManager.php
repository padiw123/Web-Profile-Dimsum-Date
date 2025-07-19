<?php

namespace App\Filament\Admin\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MenusRelationManager extends RelationManager
{
    protected static string $relationship = 'menus';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('menu_id')
                    ->relationship('menu', 'name')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Menu'),
                Tables\Columns\TextColumn::make('pivot.quantity')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('pivot.price')
                    ->label('Harga Satuan')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->state(fn ($record) => $record->pivot->quantity * $record->pivot->price),
            ])
            ->filters([
            ])
            ->headerActions([
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }
}
