<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\FormFat;
use App\Models\FormVolunteer;
use App\Models\FormAdoption;
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

        FormVolunteer::createNew($data);

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

    FormFat::createNew($data);

    return redirect('/volunteer')->with('success', 'Formulário de FAT enviado com sucesso!');
}

public function showAdoptionForm(int $id)
{
    $animal = Animal::findOrFail($id);

    return view('pages.form-adoption', [
        'animal' => $animal
    ]);
}

public function sendAdoptionForm(Request $request, $id)
{
    $animal = Animal::findOrFail($id);
    
    $data = $request->validate([
        'full_name' => 'required|string',
        'email' => 'required|email',
        'birth_date' => 'required|date',
        'nationality' => 'required|string',
        'id_number' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',

        'animals.*' => 'string',
        'residence_type.*' => 'string',
        'wall_height' => 'nullable|string',

        'lifestyle' => 'nullable|string',
        'daily_routine' => 'nullable|string',
        'dog_walks' => 'nullable|string',
        'house_access' => 'nullable|string',
        'vacation_plans' => 'nullable|string',
        'veterinarian' => 'nullable|string',
        'past_animals' => 'nullable|string',
        'concerns' => 'nullable|string',
        'unacceptable_behaviors' => 'nullable|string',
        'undesired_behaviors' => 'nullable|string',
        'dog_training' => 'nullable|string',

        'adoption_decision' => 'required|string',
        'life_changes' => 'required|string',
        'past_separations' => 'required|string',
        'family_constraints' => 'required|string',
        'responsibility' => 'accepted',
    ]);

    FormAdoption::createNew($data, $animal->id);
    
    return redirect('/animal/' . $id)->with('success', 'Formulário de adoção enviado com sucesso!');
}


}