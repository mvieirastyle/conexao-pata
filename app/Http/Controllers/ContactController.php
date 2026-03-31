<?php

namespace App\Http\Controllers;

use App\Models\FormContact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationContactEmail;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function sendContactForm(Request $request)
    {

        $data = $request->validate([
            'full_name' => 'required|string|max:25',
            'email' => 'required|email|max:55',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        FormContact::createNew($data);

        Mail::to('conexaopata@email.com')->send(new NotificationContactEmail($data));

        return redirect('/contact')->with('success', 'Mensagem enviada com sucesso!');
    }
}
