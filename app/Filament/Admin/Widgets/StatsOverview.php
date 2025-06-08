<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengunjung', Visit::count())
                ->description('Total sesi kunjungan ke website')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),
            Stat::make('Total Pendapatan', 'Rp ' . number_format(Order::sum('total_price')))
                ->description('Semua pendapatan dari pesanan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Pesanan Baru (Pending)', Order::where('status', 'pending')->count())
                ->description('Jumlah pesanan yang perlu dikonfirmasi')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pelanggan yang terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Jumlah Menu', Menu::count())
                ->description('Total varian menu yang tersedia')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('gray'),
        ];
    }
}
