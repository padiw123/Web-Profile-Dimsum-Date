<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Visit;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VisitorsChart extends ChartWidget
{
    protected static ?string $heading = 'Pengunjung Website (14 Hari Terakhir)';

    // PERBAIKAN 1: Atur urutan
    protected static ?int $sort = 2;

    // PERBAIKAN 2: Atur lebar kolom
    protected int | string | array $columnSpan = 'half';

    protected function getData(): array
    {
        $data = Visit::query()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');
        $labels = [];
        for ($i = 13; $i >= 0; $i--) {
            $labels[] = now()->subDays($i)->format('d M');
        }
        $dataset = [];
        foreach ($labels as $label) {
            $date = Carbon::createFromFormat('d M', $label)->format('Y-m-d');
            $dataset[] = $data->get($date, 0);
        }
        return [
            'datasets' => [
                [
                    'label' => 'Sesi Pengunjung',
                    'data' => $dataset,
                    'backgroundColor' => 'rgba(132, 204, 22, 0.2)',
                    'borderColor' => '#84CC16',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
