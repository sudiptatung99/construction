<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail ;

class MailController extends Controller
{
    public function index()
    {
        return view('user.layout');
    }  
    public function mail_send(Request $request){
        $contact = [
            'name' => $request->name,
            'email' => $request->email,
            'construction' => $request->Construction,
            'message' => $request->message 
        ];
        Mail::to("sudiptatung6@gmail.com")->send(new ContactMail($contact));   
        toastr()->success('Thank You For Contact Us', 'success'); 
        return back(); 
    } 
}
