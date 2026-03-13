<?php

namespace App\Exports;

use App\Models\Animal;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MicrochipsChartExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $rows = [];

        $categories = Category::pluck('type', 'id')->toArray();

        $counts = Animal::where('microchip', true)
            ->selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->get()
            ->keyBy('category_id');

        foreach ($categories as $id => $name) {
            $rows[] = [
                'Categoria' => $name,
                'Quantidade com Microchip' => $counts[$id]->total ?? 0,
            ];
        }

        return new Collection($rows);

    }

    public function headings(): array
    {
        return [
            'Categoria',
            'Quantidade com Microchip',
        ];
    }
}
