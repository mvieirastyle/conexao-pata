<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormContact extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'subject',
        'message',
    ];

    public static function create(array $data)
    {
        return self::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
    }
}
