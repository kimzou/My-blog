<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail as Email;
use App\Mail\ContactMail;
use App\User;


class ContactController extends Controller
{
    public function contact()
    {
        return view('contact.form');
    }

    public function mail(Request $request)
    {
        $data = $request->validate([
            'subject' => 'bail|required|string|max:255',
            'content' => 'bail|required'
        ]);
        $data['user_id'] = $request->user()->id; 

        $mail = Email::create($data);
        $admins = User::where('role', 'admin')->get('email');
        
        Mail::to($admins)->send(new ContactMail($mail));
            
        return redirect()->back()->with('success', 'Votre mail a bien ete envoye !');
    }

}
