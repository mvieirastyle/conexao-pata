<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAdoption extends Model
{
    protected $fillable = [
        'animal_id',
        'full_name',
        'email',
        'birth_date',
        'nationality',
        'id_number',
        'phone',
        'address',
        'animals',
        'residence_type',
        'wall_height',
        'lifestyle',
        'daily_routine',
        'dog_walks',
        'house_access',
        'vacation_plans',
        'veterinarian',
        'past_animals',
        'concerns',
        'unacceptable_behaviors',
        'undesired_behaviors',
        'dog_training',
        'adoption_decision',
        'life_changes',
        'past_separations',
        'family_constraints',
        'responsibility',
    ];

    protected $casts = [
        'animals' => 'array',
        'residence_type' => 'array',
    ];
    public static function createNew(array $data = [], int $animal_id)
    {
        return self::create([
            'animal_id' => $animal_id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'nationality' => $data['nationality'],
            'id_number' => $data['id_number'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'animals' => $data['animals'],
            'residence_type' => $data['residence_type'],
            'wall_height' => $data['wall_height'] ?? null,
            'lifestyle' => $data['lifestyle'],
            'daily_routine' => $data['daily_routine'],
            'dog_walks' => $data['dog_walks'] ?? null,
            'house_access' => $data['house_access'],
            'vacation_plans' => $data['vacation_plans'],
            'veterinarian' => $data['veterinarian'],
            'past_animals' => $data['past_animals'],
            'concerns' => $data['concerns'],
            'unacceptable_behaviors' => $data['unacceptable_behaviors'],
            'undesired_behaviors' => $data['undesired_behaviors'],
            'dog_training' => $data['dog_training'] ?? null,
            'adoption_decision' => $data['adoption_decision'],
            'life_changes' => $data['life_changes'],
            'past_separations' => $data['past_separations'],
            'family_constraints' => $data['family_constraints'],
            'responsibility' =>  isset($data['responsibility'])
        ]);
    }
}
