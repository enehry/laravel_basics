<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $contacts = DB::table('contacts')->latest()->paginate(10);

        return view('admin.contact.index', compact('contacts'));
    }

    public function Add(){
        return view('admin.contact.create');
    }

    public function Store(Request $request){
        $validate = $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        DB::table('contacts')->insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ]
    );


        return Redirect()->route('admin.contact')->with('success' , 'Contact Successfully Added');
    }

    public function Edit($id){
        $contact = DB::table('contacts')->find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function Update($id, Request $request){
        $validate = $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        DB::table('contacts')->where('id', '=', $id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.contact')->with('success' , 'Contact Successfully Updated');

    }

    public function Delete($id){

        DB::table('contacts')->delete($id);

        return Redirect()->route('admin.contact')->with('success' , 'Contact Successfully Deleted');
    }

    
}
