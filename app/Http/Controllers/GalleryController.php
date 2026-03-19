<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    private function applyFilters($query, Request $request)
    {
        if ($request->input('animal') && $request->input('animal') !== 'all') {
            $query->where('category_id', $request->input('animal'));
        }

        if ($request->input('sex') && $request->input('sex') !== 'all') {
            $query->where('sexo', $request->input('sex'));
        }

        if ($request->input('age') && $request->input('age') !== 'all') {
            $query->where('idade', $request->input('age'));
        }

        if ($request->input('size') && $request->input('size') !== 'all') {
            $query->where('porte', $request->input('size'));
        }

        return $query;
    }

    public function show(Request $request): View
    {
        $query = Animal::with(['vacinas', 'category', 'fotos'])
            ->where('disponivel', true);

        $query = $this->applyFilters($query, $request);

        $animals = $query->paginate(6)->withQueryString();

        return view('pages.gallery', [
            'animals' => $animals,
        ]);
    }
}

