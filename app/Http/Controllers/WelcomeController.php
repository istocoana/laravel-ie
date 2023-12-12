<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
class WelcomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showContactForm()
    {
        return view('contact');
    }

    public function sendContactForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('info.mailerie@gmail.com')->send(new ContactMail($validatedData));

        return redirect()->route('contact')->with('success', 'Mesajul a fost trimis cu succes!');
    }
}      
