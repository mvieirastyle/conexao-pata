<?php

namespace App\Exports;

use App\Models\Animal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdoptionsChartExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection($inicialDate = null , $lastDate = null)
    {
        $rows = [];

        $query = Animal::query();

        if ($inicialDate) {
            $query->whereDate('data_adocao', '>=', $inicialDate);
        }

        if ($lastDate) {
            $query->whereDate('data_adocao', '<=', $lastDate);
        }


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
            $rows [] = [
                'Mês/ano' => Carbon::create()->month($monthData['month'])->translatedFormat('M') . '/' . $monthData['year'],
                'Cães' => $monthData[1] ?? 0,  
                'Gatos' => $monthData[2] ?? 0,  
            ];
        }

        return new Collection($rows);
    }

    public function headings(): array
    {
        return [
            'Mês/ano',
            'Quantidade de entradas - Cães',
            'Quantidade de entradas - Gatos',
        ];
    }
}
