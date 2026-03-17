<?php

namespace App\Http\Controllers;

use App\Models\FormContact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View{
     return view('pages.contact');
    }

    public function send(Request $request){
        $data = $request->validate([
            'full_name' => 'required|string|max:25',
            'email' => 'required|email|max:55',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        FormContact::create($data); 

        return redirect('/contact')->with('success', 'Mensagem enviada com sucesso!');
    }

}
