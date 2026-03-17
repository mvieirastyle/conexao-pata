<?php

namespace App\Exports;

use App\Models\Animal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdocoesChartExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection($startDate = null, $endDate = null)
    {
         $adocoesQuery = Animal::whereNotNull('data_adocao');
        if ($startDate) {
            $adocoesQuery->whereDate('data_adocao', '>=', $startDate);
        }
        if ($endDate) {
            $adocoesQuery->whereDate('data_adocao', '<=', $endDate);
        }
        $adocoes = $adocoesQuery->selectRaw("
            YEAR(data_adocao) as year,
            MONTH(data_adocao) as month,
            COUNT(*) as total
        ")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn($item) => $item->year . '-' . $item->month);

        $entradasQuery = Animal::whereNotNull('data_entrada');
        if ($startDate) {
            $entradasQuery->whereDate('data_entrada', '>=', $startDate);
        }
        if ($endDate) {
            $entradasQuery->whereDate('data_entrada', '<=', $endDate);
        }
        $entradas = $entradasQuery->selectRaw("
            YEAR(data_entrada) as year,
            MONTH(data_entrada) as month,
            COUNT(*) as total
        ")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn($item) => $item->year . '-' . $item->month);


        $allKeys = $adocoes->keys()->merge($entradas->keys())->unique()->sort();

        $rows = [];
        foreach ($allKeys as $key) {
            [$year, $month] = explode('-', $key);
            $monthName = Carbon::create()->month((int)$month)->translatedFormat('M');

            $rows[] = [
                'Mês/ano' => $monthName . '/' . $year,
                'Qnt. Adoções' => $adocoes[$key]->total ?? 0,
                'Qnt. Acolhimentos' => $entradas[$key]->total ?? 0,
            ];
        }

        return new Collection($rows);
    }

    public function headings(): array
    {
        return [
            'Mês/ano',
            'Quantidade de adoções',
            'Quantidade de acolhimentos',
        ];
    }
}
