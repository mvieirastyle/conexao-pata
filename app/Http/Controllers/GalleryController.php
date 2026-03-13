<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function show(): View
    {
        $animals = Animal::with(['vacinas', 'category', 'fotos'])
        ->where('disponivel', true);

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

        $animals = $query->paginate(6)->withQueryString();

        return view('pages.gallery', [
            'animals' => $animals,
        ]);
    }

    public function showFilter(Request $request): View
    {
        $query = Animal::query();

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

        $animals = $query->paginate(6)->withQueryString();

        return view('pages.gallery', [
            'animals' => $animals,
        ]);
    }
}
