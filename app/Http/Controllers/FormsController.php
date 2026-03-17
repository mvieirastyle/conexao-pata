<?php

namespace App\Http\Controllers;

use App\Models\Form_fat;
use App\Models\Form_volunteer;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function showVolunteerForm()
    {
        return view('pages.form-volunteer');
    }

    public function showFatForm()
    {
        return view('pages.form-fat');
    }

    public function sendVolunteerForm(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:25',
            'email' => 'required|email|max:55',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:50',
            'id_number' => 'required|string|max:9',
            'phone' => 'required|string|max:9',
            'address' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'company_school' => 'nullable|string|max:255',
            'hobbies' => 'nullable|string|max:255',
            'transport' => 'required|string|max:255',

            'animals.*' => 'string',
            'area.*' => 'string',
            'activities.*' => 'string',
            'courses.*' => 'string',

            'accident_responsibility' => 'accepted',
            'adaptation_terms' => 'accepted'
        ]);

        Form_volunteer::createNew($data);

        return redirect('/volunteer')->with('success', 'Formulário de voluntariado enviado com sucesso!');
    }

public function sendFatForm(Request $request)
{
    $data = $request->validate([
        'full_name' => 'required|string|max:25',
        'email' => 'required|email|max:55',
        'birth_date' => 'required|date',
        'nationality' => 'required|string|max:50',
        'id_number' => 'required|string|max:9',
        'phone' => 'required|string|max:9',

        'fat_experience' => 'nullable|string|max:255',

        'availability' => 'required|string|max:255',

        'animals.*' => 'string',
        'residence_type.*' => 'string',

        'accident_responsibility' => 'accepted',
        'adaptation_terms' => 'accepted'
    ]);

    Form_fat::createNew($data);

    return redirect('/volunteer')->with('success', 'Formulário de FAT enviado com sucesso!');
}
}
