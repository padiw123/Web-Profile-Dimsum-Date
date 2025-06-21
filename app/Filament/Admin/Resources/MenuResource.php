<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Admin\Resources\MenuResource\Pages;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationGroup = 'Manajemen Website';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-m-book-open';
    protected static ?string $navigationLabel = 'Menu';
    protected static ?string $pluralModelLabel = 'Menus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('category')->required(),
                Forms\Components\Textarea::make('description')->required(),
                Forms\Components\FileUpload::make('image_url') ->label('Image')
                ->image()
                ->directory('menus')
                ->visibility('public')
                ->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('display_image_url')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->money('IDR'),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            TextEntry::make('category')->label('Kategori')->state($record->category),
            TextEntry::make('price')->label('Harga')->state('Rp ' . number_format($record->price, 0, ',', '.')),
        ];
    }

    public static function getGlobalSearchResultAvatar(Model $record): ?string
    {
        return $record->display_image_url;
    }
}
