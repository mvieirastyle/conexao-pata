<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormContact extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'email',
        'subject',
        'message',
        'accept'
    ];

    public static function createNew(array $data = [])
    {
        return self::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
    }
}
