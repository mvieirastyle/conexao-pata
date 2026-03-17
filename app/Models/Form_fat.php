<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_fat extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'full_name',
        'email',
        'birth_date',
        'nationality',
        'id_number',
        'phone',
        'fat_experience',
        'animals',
        'availability',
        'residence_type',
        'accident_responsibility',
        'adaptation_terms',
    ];

    protected $casts = [
        'animals' => 'array',
        'residence_type' => 'array',
        'accident_responsibility' => 'boolean',
        'adaptation_terms' => 'boolean'
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
            'fat_experience' => $data['fat_experience'] ?? null,
            'animals' => $data['animals'],
            'availability' => $data['availability'],
            'residence_type' => $data['residence_type'],
            'accident_responsibility' => isset($data['accident_responsibility']),
            'adaptation_terms' => isset($data['adaptation_terms'])
        ]);
    }
}
