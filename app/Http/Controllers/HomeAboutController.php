<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeAboutController extends Controller
{
    //
    public function Index(){
        $homeAbout = DB::table('home_abouts')->latest()->paginate(5);

        return view('admin.home_about.index', compact('homeAbout'));
    }

    public function Add(){
        return view('admin.home_about.create');
    }

    public function Insert(Request $request){
        $validatedData = $request->validate(
            [
                'title' => 'required|min:4',
            ],
        );

        DB::table('home_abouts')->insert(
            [
                'title' => $request->title,
                'short_des' => $request->short_description,
                'long_des' => $request->long_description,
                'created_at' => Carbon::now(),
            ]
        );

        return Redirect()->back()->with('success', 'Home About Successfully Addded');
    }

    public function Edit($id){

        $about = DB::table('home_abouts')->find($id);

        return view('admin.home_about.edit', compact('about'));
    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate(
            [
                'title' => 'required|min:4',
            ],
        );

        DB::table('home_abouts')->where('id', '=', $id)->update(
            [
                'title' => $request->title,
                'short_des' => $request->short_description,
                'long_des' => $request->long_description,
                'updated_at' => Carbon::now(),
            ]
        );

        return Redirect()->route('home.about')->with('success', 'Home About Successfully Addded');
    }

    public function delete($id){

        DB::table('home_abouts')->delete($id);

        return Redirect()->back()->with('success', 'Data Successfully Deleted');
    }

    public function Portfolio(){

        $multipics = DB::table('multipics')->latest()->get();

        return view('layouts.pages.portfolio', compact('multipics'));
    }
}
