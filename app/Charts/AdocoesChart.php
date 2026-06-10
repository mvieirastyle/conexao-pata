<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Animal;
use Illuminate\Support\Carbon;

class AdocoesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\AreaChart
{
    $start = request('start_date');
    $end = request('end_date');


    $adocoesQuery = Animal::whereNotNull('data_adocao');

    if ($start && $end) {
        $adocoesQuery->whereBetween('data_adocao', [$start, $end]);
    }

    $adocoes = $adocoesQuery->selectRaw("
            YEAR(data_adocao) as year,
            MONTH(data_adocao) as month,
            COUNT(*) as total
        ")
        ->groupBy('year', 'month')
        ->get()
        ->keyBy(fn($item) => $item->year . '-' . $item->month);


    $entradasQuery = Animal::whereNotNull('data_entrada');

    if ($start && $end) {
        $entradasQuery->whereBetween('data_entrada', [$start, $end]);
    }

    $entradas = $entradasQuery->selectRaw("
            YEAR(data_entrada) as year,
            MONTH(data_entrada) as month,
            COUNT(*) as total
        ")
        ->groupBy('year', 'month')
        ->get()
        ->keyBy(fn($item) => $item->year . '-' . $item->month);

    $allKeys = $adocoes->keys()->merge($entradas->keys())->unique()->sort();

    $labels = [];
    $adocoesData = [];
    $entradasData = [];

    foreach ($allKeys as $key) {
        [$year, $month] = explode('-', $key);

        $monthName = Carbon::create()->month((int)$month)->translatedFormat('M');

        $labels[] = $monthName . '/' . $year;

        $adocoesData[] = $adocoes[$key]->total ?? 0;
        $entradasData[] = $entradas[$key]->total ?? 0;
    }

    return $this->chart->areaChart()
        ->setTitle(__('common.title_adoption_chart'))
        ->addData($adocoesData, 'Adoções')
        ->addData( $entradasData, 'Acolhimentos')
        ->setXAxis($labels)
        ->setColors(['#00aa69', '#ffa600'])
        ->setGrid(color: '#bebebe', opacity: 0.1, strokeDashArray: 10);
}
}
