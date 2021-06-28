<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Contact;

class ContactController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function getContact() { 

        return view('home'); 
       } 
 
      public function saveContact(Request $request) { 
         $this->validate($request, [
             'email' => 'required|email',
             'subject' => 'required',
             'message' => 'required'
         ]);
 
         $contact = new Contact;
 
         $contact->email = $request->email;
         $contact->subject = $request->subject;
         $contact->message = $request->message;
 
         $contact->save();
 
         \Mail::send('contact_email',
              array(
                  'email' => $request->get('email'),
                  'subject' => $request->get('subject'),
                  'user_message' => $request->get('message'),
              ), function($message) use ($request)
                {
                   $message->from($request->email);
                   $message->to('ayomideoye112@gmail.com');
                });
 
           return back()->with('success', 'Thanks for contacting us! We will get back to you very soon.!');
 
     }
}
