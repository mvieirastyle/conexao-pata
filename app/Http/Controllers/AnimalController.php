<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\Category;
use App\Models\Fotos;
use App\Models\Vacina;
use App\Exports\AnimalsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;

class AnimalController extends Controller
{
    private function getAnimalsCacheKey()
    {
        $filters = request()->only(['animal', 'sex', 'age', 'size', 'disponivel']);
        $page = request('page', 1);

        $version = Cache::get('animals_cache_version', 1);

        return 'animals_' . $version . '_' . md5(json_encode($filters) . '_page_' . $page);
    }


    public function show()
    {
        $animals =  Cache::remember($this->getAnimalsCacheKey(), now()->addHours(3), function () {

            $query = Animal::query();

            if (request('animal')) {
                $query->where('category_id', request('animal'));
            }

            if (request('sex')) {
                $query->where('sexo', request('sex'));
            }

            if (request('age')) {
                $query->where('idade', request('age'));
            }

            if (request('size')) {
                $query->where('porte', request('size'));
            }

            if (request('disponivel')) {
                $query->where('disponivel', request('disponivel'));
            }

            return $query->paginate(6)->withQueryString();
        });

        return view('pages.admin.animal.list', [
            'animals' => $animals,
        ]);
    }

    public function showAdd()
    {
        $categories = Category::all();
        $vacinas = Vacina::all();

        return view('pages.admin.animal.add', [
            'categories' => $categories,
            'vacinas' => $vacinas,
        ]);
    }

    public function add(AnimalRequest $request)
    {
        $request->validated();

        Animal::createNew($request->all());

        Cache::increment('animals_cache_version');

        return redirect('/admin/animal/list')->with('success', 'Animal adicionado com sucesso');
    }


    public function showEdit(int $id)
    {
        $animal = Animal::with(['vacinas', 'category', 'fotos'])->find($id);
        $categories = Category::all();
        $vacinas = Vacina::all();
        $vacinasSelecionadas = $animal->vacinas->pluck('id')->toArray();


        return view('pages.admin.animal.edit', [
            'animal' => $animal,
            'categories' => $categories,
            'vacinas' => $vacinas,
            'vacinasSelecionadas' => $vacinasSelecionadas,
        ]);
    }


    public function update(AnimalRequest $request, int $id)
    {
        $request->validated();

        Animal::updateAnimal($id, $request->all());

        Cache::increment('animals_cache_version');

        return redirect('/admin/animal/list')->with('success', 'Animal editado com sucesso');
    }

    public function delete($id)
    {
        Animal::deleteAnimal($id);

        Cache::increment('animals_cache_version');

        return redirect('/admin/animal/list')->with('success', 'Animal removido com sucesso');
    }

    public function exportExcel()
    {
        return Excel::download(new AnimalsExport, 'animais-excel.xlsx');
    }

    public function generatePdf(Animal $animals)
    {
        $pdf = Pdf::loadView('pages.admin.animal.generate-pdf', ['animals' => $animals->all()]);

        return $pdf->download('relatorio-animais.pdf');
    }

    public function generatePdfAnimalsChart(array $rows = [])
    {
        $categories = Category::pluck('type', 'id')->toArray();

        $counts = Animal::selectRaw('category_id, sexo, COUNT(*) as total')
            ->groupBy('category_id', 'sexo')
            ->get();


        $grouped = [];

        foreach ($counts as $count) {
            $grouped[$count->category_id][$count->sexo] = $count->total;
        }

        foreach ($categories as $id => $name) {
            $rows[] = [
                'tipo' => $name,
                'machos' => $grouped[$id]['Macho'] ?? 0,
                'femeas' => $grouped[$id]['Fêmea'] ?? 0,
            ];
        }

        $pdf = Pdf::loadView('pages.admin.pdf-animais', ['rows' => $rows]);

        return $pdf->download('relatorio-animais-grafico.pdf');
    }

    public function generatePdfAdocoesChart($startDate = null, $endDate = null)
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

        $pdf = Pdf::loadView('pages.admin.pdf-adocoes', ['rows' => $rows]);

        return $pdf->download('relatorio-adocoes-e-acolhimentos.pdf');
    }

    public function generatePdfMicrochipsChart(array $rows = [])
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
                'tipo' => $name,
                'com_microchip' => $counts[$id]->total ?? 0,
            ];
        }


        $pdf = Pdf::loadView('pages.admin.pdf-microchips', ['rows' => $rows]);

        return $pdf->download('relatorio-microchips-grafico.pdf');
    }
    public function generatePdfEntradasChart($inicioData = null, $fimData = null)
    {
        $rows = [];

        $query = Animal::whereNotNull('data_entrada');

        if ($inicioData) {
            $query->whereDate('data_entrada', '>=', $inicioData);
        }

        if ($fimData) {
            $query->whereDate('data_entrada', '<=', $fimData);
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
            $rows[] = [
                'Mês/ano' => Carbon::create()->month($monthData['month'])->translatedFormat('M') . '/' . $monthData['year'],
                'Quantidade de entradas - Cães' => $monthData[1] ?? 0,
                'Quantidade de entradas - Gatos' => $monthData[2] ?? 0,
            ];
        }
        $pdf = Pdf::loadView('pages.admin.pdf-entradas', ['rows' => $rows]);

        return $pdf->download('relatorio-entradas-grafico.pdf');
    }

    public function generatePdfAdoptionsChart($inicialDate = null, $lastDate = null)
    {
        $rows = [];

        $query = Animal::whereNotNull('data_adocao');

        if ($inicialDate) {
            $query->whereDate('data_adocao', '>=', $inicialDate);
        }

        if ($lastDate) {
            $query->whereDate('data_adocao', '<=', $lastDate);
        }


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
            $rows[] = [
                'Mês/ano' => Carbon::create()->month($monthData['month'])->translatedFormat('M') . '/' . $monthData['year'],
                'Quantidade de adoções - Cães' => $monthData[1] ?? 0,
                'Quantidade de adoções - Gatos' => $monthData[2] ?? 0,
            ];
        }
        $pdf = Pdf::loadView('pages.admin.pdf-adoptions', ['rows' => $rows]);

        return $pdf->download('relatorio-adocoes-grafico.pdf');
    }
}
