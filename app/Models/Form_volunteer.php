<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_volunteer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'email',
        'birth_date',
        'nationality',
        'id_number',
        'phone',
        'address',
        'occupation',
        'company_school',
        'hobbies',
        'transport',
        'animals',
        'area',
        'activities',
        'courses',
        'accident_responsibility',
        'adaptation_terms'
    ];

    protected $casts = [
        'animals' => 'array',
        'area' => 'array',
        'activities' => 'array',
        'courses' => 'array',
    ];
    
    public static function createNew(array $data = [])
    {
        return self::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'nationality' => $data['nationality'],
            'id_number' => $data['id_number'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'occupation' => $data['occupation'],
            'company_school' => $data['company_school'] ?? null,
            'hobbies' => $data['hobbies'] ?? null,
            'transport' => $data['transport'],
            'animals' => $data['animals'],
            'area' => $data['area'],
            'activities' => $data['activities'],
            'courses' => $data['courses'],
            'accident_responsibility' => isset($data['accident_responsibility']),
            'adaptation_terms' => isset($data['adaptation_terms'])
        ]);
    }
}
