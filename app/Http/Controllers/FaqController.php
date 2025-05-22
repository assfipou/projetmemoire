<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FaqController extends Controller
{
    public function submitQuestion(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'question' => 'required|string|max:1000',
        ]);

        // Envoie par email (option simple)
        Mail::raw("Nouvelle question de: {$validated['email']}\n\nQuestion:\n{$validated['question']}", function ($message) use ($validated) {
            $message->to('babacar3.faye@uadb.edu.sn')
                    ->subject('Nouvelle question FAQ');
        });

        return back()->with('success', 'Votre question a été envoyée. Merci !');
    }
}
