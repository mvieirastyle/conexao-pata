<?php

namespace App\Charts;

use App\Models\Animal;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;

class EntradasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($inicioData = null, $fimData = null): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $labels = [];
        $counts = [
            'Cães' => [],
            'Gatos' => [],
        ];
        
        $inicio = request('inicioData');
        $fim = request('fimData');

        $query = Animal::query();

        if ($inicio && $fim) {
            $query->whereBetween('data_entrada', [$inicio, $fim]);
        }

        $data = $query->get();


        $data = $query->selectRaw("
                YEAR(data_entrada) as year,
                MONTH(data_entrada) as month,
                category_id,
                COUNT(*) as total
            ")
            ->groupBy('year', 'month', 'category_id')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = [];

        foreach ($data as $row) {
            $monthKey = $row->month . '-' . $row->year;
            $months[$monthKey]['month'] = $row->month;
            $months[$monthKey]['year'] = $row->year;
            $months[$monthKey][$row->category_id] = $row->total;
        }

        foreach ($months as $monthKey => $monthData) {
            $monthName = Carbon::create()->month($monthData['month'])->translatedFormat('M');
            $labels[] = $monthName . '/' . $monthData['year'];

            $counts['Cães'][] = $monthData[1] ?? 0;
            $counts['Gatos'][] = $monthData[2] ?? 0;
        }

        $horizontalChart = $this->chart->horizontalBarChart()
            ->setTitle(__('common.title_entries_chart'))
            ->setXAxis($labels)
            ->setGrid(color: '#bebebe', opacity: 0.1, strokeDashArray: 10)
            ->setColors(['#00aa69', '#ffaf46']);

        foreach ($counts as $label => $data) {
            $horizontalChart->addData($data, $label);
        }

        return $horizontalChart;
    }
}
