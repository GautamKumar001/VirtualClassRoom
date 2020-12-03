<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Contactcontroller extends Controller
{
    public function create()
    {
        return view('contact');
    }
    public function store()
    {
        $data=request()->validate(
            [
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required',
                'message'=>'required'
            ]
        );
        Mail::to('mailmelearnersociety665@gmail.com')->send(new ContactFormMail($data));
        return redirect('contact')->with('message', 'Thank you for your message.We will in touch');
        // dd(request()->all());
    }
}
