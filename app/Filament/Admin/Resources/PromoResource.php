<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Promo;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use App\Filament\Admin\Resources\PromoResource\Pages;

class PromoResource extends Resource
{
    protected static ?string $model = Promo::class;
    protected static ?string $navigationGroup = 'Manajemen Website';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Promo';
    protected static ?string $pluralModelLabel = 'Promotions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description')->required(),
                Forms\Components\TextInput::make('price')->label('Minimal Belanja (Rp)')->numeric()->prefix('Rp')->helperText('Isi jika promo memerlukan minimal belanja. Kosongkan jika tidak ada syarat.'),
                Forms\Components\TextInput::make('price_note'),
                Forms\Components\TagsInput::make('features')->placeholder('Add features one by one'),
                Forms\Components\TextInput::make('cta_link')->label('CTA Link'),
                Forms\Components\Section::make('Discount Settings')
                    ->schema([
                        Select::make('discount_type')
                            ->options([
                                'fixed' => 'Fixed Amount (Rp)',
                                'percentage' => 'Percentage (%)',
                            ])
                            ->live()
                            ->placeholder('Select discount type'),

                        Forms\Components\TextInput::make('discount_value')
                            ->numeric()
                            ->required(fn (callable $get) => $get('discount_type') !== null) // Required if type is selected
                            ->visible(fn (callable $get) => $get('discount_type') !== null) // Visible if type is selected
                            ->prefix(fn (callable $get) => $get('discount_type') === 'fixed' ? 'Rp' : null)
                            ->suffix(fn (callable $get) => $get('discount_type') === 'percentage' ? '%' : null),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->money('USD'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromos::route('/'),
            'create' => Pages\CreatePromo::route('/create'),
            'edit' => Pages\EditPromo::route('/{record}/edit'),
        ];
    }
}
