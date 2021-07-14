<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }


    public function AddBrand(Request $request){

        $validatedData = $request->validate(
            [
                'brand_name' => 'required|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Brand name cannot be empty',
                'brand_name.max' => 'Brand name must only 4 characters and above',
            ]
        );

        $brand_image = $request->file('brand_image');

        // $name_generate = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_generate.'.'.$img_ext;

        // $upload_loc = 'image/brand/';
        // $img_url = $upload_loc.$img_name;
        // $brand_image->move($upload_loc, $img_name);

        $name_generate = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_generate);

        $img_url = 'image/brand/'.$name_generate;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $img_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Edit($id){
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate(
            [
                'brand_name' => 'required|min:4',
            ],
            [
                'brand_name.required' => 'Brand name cannot be empty',
                'brand_name.max' => 'Brand name must only 4 characters and above',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_generate.'.'.$img_ext;

            $upload_loc = 'image/brand/';
            $img_url = $upload_loc.$img_name;
            $brand_image->move($upload_loc, $img_name);

            unlink($old_image);
            Brand::find($id)->Update([
                'brand_name' => $request->brand_name,
                'brand_image' => $img_url,
                'updated_at' => Carbon::now()
            ]);
        } else {
            Brand::find($id)->Update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
        }

        
        $notification = array(
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Delete($id){

        $image = Brand::find($id)->brand_image;
        unlink($image);

        $delete = Brand::find($id)->delete();
        
        $notification = array(
            'message' => 'Successfully deleted',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

    public function logout(){
        Auth::logout();

        
        $notification = array(
            'message' => 'Successfully logout',
            'alert-type' => 'info'
        );

        return Redirect()->route('login')->with($notification);
    }
}
