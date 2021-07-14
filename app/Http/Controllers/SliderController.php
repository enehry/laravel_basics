<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    //
    public function Index()
    {
        $sliders = DB::table('sliders')->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function Add()
    {
        return view('admin.slider.create');
    }

    public function Store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png',
            ],
        );

        $sliderImage = $request->file('image');

        $name_generate = hexdec(uniqid()) . '.' . $sliderImage->getClientOriginalExtension();
        Image::make($sliderImage)->resize(1920, 1088)->save('image/slider/' . $name_generate);

        $img_url = 'image/slider/' . $name_generate;

        Slider::insert([
            'title' => $request->title,
            'image' => $img_url,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Brand Inserted Successfully');
    }


    public function Edit($id)
    {
        $slider = DB::table('sliders')->find($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function Update(Request $request)
    {
        
        $sliderImage = $request->file('image');

        if ($sliderImage) {
            $validatedData = $request->validate(
                [
                    'image' => 'required|mimes:jpg,jpeg,png',
                ],
            );
    
            $name_generate = hexdec(uniqid()) . '.' . $sliderImage->getClientOriginalExtension();
            Image::make($sliderImage)->resize(1920, 1088)->save('image/slider/' . $name_generate);

            $img_url = 'image/slider/' . $name_generate;


            DB::table('sliders')->where('id', '=', $request->id)->update(
                [
                    'title' => $request->title,
                    'image' => $img_url,
                    'description' => $request->description,
                    'updated_at' => Carbon::now()
                ]
            );
        } else {
            DB::table('sliders')->where('id', '=', $request->id)->update(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'updated_at' => Carbon::now()
                ]
            );
        }


        return Redirect()->route('home.slider')->with('success', 'Slider Successfully Updated');
    }

    public function Delete($id){
        DB::table('sliders')->delete($id);

        return Redirect()->back()->with('success', 'Slider Successfully Updated');
    }
}
