<?php

namespace App\Filament\Admin\Resources;

use App\Models\Order;
use App\Models\Menu;
use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationGroup = 'Manajemen Pesanan';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $recordTitleAttribute = 'id';
    protected static ?string $pluralModelLabel = 'Pesanan';


    

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return "Pesanan #" . $record->id;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['id', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Order Details')
                            ->schema([
                                Forms\Components\Select::make('user_id')->relationship('user', 'name')->searchable()->required(),
                                Forms\Components\Select::make('service_type')->label('Jenis Layanan')->options(['dine_in' => 'Dine In', 'take_away' => 'Take Away'])->required(),
                                Forms\Components\Textarea::make('notes')->columnSpanFull()->required(),
                            ])->columns(2),

                        Forms\Components\Section::make('Menu yang Dipesan')
                            ->schema([
                                Forms\Components\Repeater::make('menus') // Nama sesuai relasi
                                    ->schema([
                                        Forms\Components\Select::make('menu_id')
                                            ->label('Menu')
                                            ->options(Menu::query()->pluck('name', 'id'))
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('price', Menu::find($state)?->price ?? 0))
                                            ->columnSpan(4),

                                        Forms\Components\TextInput::make('quantity')->numeric()->required()->default(1)->minValue(1)->columnSpan(2)->reactive(),
                                        Forms\Components\TextInput::make('price')->label('Harga Satuan')->numeric()->required()->disabled()->dehydrated()->columnSpan(2),
                                    ])
                                    ->columns(8)
                                    ->addActionLabel('Tambah Menu')
                                    ->live()
                                    ->afterStateUpdated(function (callable $get, callable $set) {
                                        $total = 0;
                                        foreach ($get('menus') as $item) {
                                            $total += $item['price'] * $item['quantity'];
                                        }
                                        $set('total_price', $total);
                                    }),
                            ]),
                    ])->columnSpan(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Status & Payment')
                            ->schema([
                                Forms\Components\TextInput::make('total_price')->label('Total Harga')->numeric()->readOnly()->prefix('Rp'),
                                Forms\Components\Select::make('status')->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'])->required(),
                                Forms\Components\Select::make('payment_method')->options(['qris' => 'QRIS', 'cimb' => 'CIMB Niaga', 'mandiri' => 'Mandiri', 'cash' => 'Tunai di Tempat'])->required(),
                                Forms\Components\Select::make('payment_status')->options(['unpaid' => 'Unpaid', 'paid' => 'Paid', 'failed' => 'Failed'])->required(),
                            ]),
                    ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total Harga')->prefix('Rp')->numeric(decimalPlaces: 0)->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning', 'confirmed' => 'primary', 'completed' => 'success', 'cancelled' => 'danger', default => 'gray',
                })->searchable(),
                Tables\Columns\TextColumn::make('payment_status')->label('Pembayaran')->badge()->color(fn (string $state): string => match ($state) {
                    'unpaid' => 'warning', 'paid' => 'success', 'failed' => 'danger', default => 'gray',
                })->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Pesan')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled']),
                Tables\Filters\SelectFilter::make('payment_status')->options(['unpaid' => 'Unpaid', 'paid' => 'Paid']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(3)->schema([
                    Infolists\Components\Group::make()->schema([
                        Infolists\Components\Section::make('Order Details')
                            ->schema([
                                Infolists\Components\TextEntry::make('user.name')->label('Nama Pemesan'),
                                Infolists\Components\TextEntry::make('service_type')->label('Jenis Layanan')->badge()->formatStateUsing(fn ($state) => $state === 'dine_in' ? 'Dine In' : 'Take Away')->color(fn ($state) => $state === 'dine_in' ? 'info' : 'success'),
                                Infolists\Components\TextEntry::make('notes')->label('Catatan'),
                                Infolists\Components\TextEntry::make('created_at')->label('Waktu Pesan')->dateTime(),
                            ])->columns(2),
                    ])->columnSpan(2),

                    Infolists\Components\Group::make()->schema([
                        Infolists\Components\Section::make('Status & Payment')
                            ->schema([
                                Infolists\Components\TextEntry::make('total_price')->label('Total Harga')->prefix('Rp')->numeric(decimalPlaces: 0),
                                Infolists\Components\TextEntry::make('status')->badge()->color(fn (string $state): string => match ($state) {
                                    'pending' => 'warning', 'confirmed' => 'primary', 'completed' => 'success', 'cancelled' => 'danger', default => 'gray',
                                }),
                                Infolists\Components\TextEntry::make('payment_status')->label('Status Pembayaran')->badge()->color(fn (string $state): string => match ($state) {
                                    'unpaid' => 'warning', 'paid' => 'success', 'failed' => 'danger', default => 'gray',
                                }),
                                Infolists\Components\TextEntry::make('payment_method')->label('Metode Bayar'),
                            ]),
                    ])->columnSpan(1),
                ]),

                Infolists\Components\Section::make('Menu yang Dipesan')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('menus')
                            ->hiddenLabel()
                            ->schema([
                                Infolists\Components\TextEntry::make('name')->label('Nama Menu')->weight('bold'),
                                Infolists\Components\TextEntry::make('pivot.quantity')->label('Kuantitas')->prefix('x '),
                                Infolists\Components\TextEntry::make('pivot.price')->label('Harga Satuan')->money('IDR')->numeric(decimalPlaces: 0),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            // 'view' => Pages\ViewOrder::route('/{record}'), // Pastikan halaman view terdaftar
        ];
    }
}
