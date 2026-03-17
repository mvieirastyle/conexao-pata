<?php

namespace App\Charts;

use App\Models\Animal;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;

class AdoptionsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($inicialDate = null, $lastDate = null): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $labels = [];
        $counts = [
            'Cães' => [],
            'Gatos' => [],
        ];

        $inicialDate = request('inicialDate');
        $lastDate = request('lastDate');

        $query = Animal::query();

        if ($inicialDate && $lastDate) {
            $query->whereBetween('data_adocao', [$inicialDate, $lastDate]);
        }

        $data = $query->get();


        $data = $query->selectRaw("
                YEAR(data_adocao) as year,
                MONTH(data_adocao) as month,
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
            ->setTitle('Quantidade de Animais Adotados por Mês')
            ->setXAxis($labels)
            ->setGrid(color: '#bebebe', opacity: 0.1, strokeDashArray: 10)
            ->setColors(['#00aa69', '#ffaf46']);

        foreach ($counts as $label => $data) {
            $horizontalChart->addData($data, $label);
        }

        return $horizontalChart;
    }
}
