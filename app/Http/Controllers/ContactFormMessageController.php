<?php

namespace App\Http\Controllers;

use App\Models\ContactFormMessage;
use Illuminate\Http\Request;

class ContactFormMessageController extends Controller
{
    //
    public function Index(){
        $messages = ContactFormMessage::latest()->paginate(10);
        return view('admin.contact.message.index', compact('messages'));
    }

    public function Delete($id){ 
        ContactFormMessage::destroy($id);

        return Redirect()->back()->with('success', 'Message successfully deleted');
    }
}
