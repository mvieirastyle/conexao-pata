<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Form_fat;
use App\Models\Form_volunteer;
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

public function showAdoptionForm(int $id)
{
    $animal = Animal::findOrFail($id);

    return view('pages.formAdoption', [
        'animal' => $animal
    ]);
}

public function sendAdoptionForm(Request $request, $id)
{
    $animal = Animal::findOrFail($id);
    $data = $request->validate([
        'full_name' => 'required|string|max:25',
        'email' => 'required|email|max:55',
        'birth_date' => 'required|date',
        'nationality' => 'required|string|max:50',
        'id_number' => 'required|string|max:9',
        'phone' => 'required|string|max:9',
        'address' => 'required|string|max:255',
        'animals.*' => 'string',
        'residence_type.*' => 'string',
        'wall_height' => 'nullable|string',
        'lifestyle' => 'required|string|max:255',   
        'daily_routine' => 'required|string|max:255',
        'dog_walks' => 'nullable|string|max:255',
        'house_access' => 'required|string|max:255',
        'vacation_plans' => 'required|string|max:255',
        'veterinarian' => 'required|string|max:255',
        'past_animals' => 'required|string|max:255',
        'concerns' => 'required|string|max:255',
        'unacceptable_behaviors' => 'required|string|max:255',
        'undesired_behaviors' => 'required|string|max:255',
        'dog_training' => 'nullable|string|max:255',
        'adoption_decision' => 'required|string|max:255',
        'life_changes' => 'required|string|max:255',
        'past_separations' => 'required|string|max:255',
        'family_constraints' => 'required|string|max:255',
        'responsibility' => 'accepted',
     ]); 

     FormAdoption::createNew($data, $animal->id);
    
     return redirect('/animal/' .$id)->with('success', 'Formulário de adoção enviado com sucesso!');
}

}