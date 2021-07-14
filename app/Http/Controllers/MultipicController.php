<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MultipicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function Index(){
        $multipics = Multipic::latest()->paginate(5);

        return view('admin.multipic.index', compact('multipics'));
    }

    public function Store(Request $request){
        
        
        $images = $request->file('image');

        foreach ($images as $image) {
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('image/multi/'.$name_generate);
    
            $img_url = 'image/multi/'.$name_generate;
    
            Multipic::insert([
                'image' => $img_url,
                'created_at' => Carbon::now()
            ]);
        }
        // $name_generate = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_generate.'.'.$img_ext;

        // $upload_loc = 'image/brand/';
        // $img_url = $upload_loc.$img_name;
        // $brand_image->move($upload_loc, $img_name);

       

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }
}
