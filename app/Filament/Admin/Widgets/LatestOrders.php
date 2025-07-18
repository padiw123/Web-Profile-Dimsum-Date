<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    // PERBAIKAN 1: Atur urutan agar muncul paling bawah
    protected static ?int $sort = 4;
    
    // PERBAIKAN 2: Pastikan lebar kolom adalah 'full'
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        // ... kode table() tidak berubah ...
        return $table
            ->query(OrderResource::getModel()::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Order ID'),
                Tables\Columns\TextColumn::make('user.name')->label('Pelanggan'),
                Tables\Columns\TextColumn::make('status')->label('Status Pesanan')->badge(),
                Tables\Columns\TextColumn::make('payment_status')->label('Status Pembayaran')->badge(),
                Tables\Columns\TextColumn::make('total_price')->label('Total')->money('IDR'),
            ])
            ->actions([
                Tables\Actions\Action::make('Lihat / Kelola')
                    ->url(fn ($record): string => OrderResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
