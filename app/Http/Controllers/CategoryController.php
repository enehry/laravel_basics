<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function AllCat()
    {

        // $categories = DB::table('categories')
        //                 ->join('users', 'categories.user_id', 'users.id')
        //                 ->select('categories.*', 'users.name')
        //                 ->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trashCategory = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCategory'));
    }

    public function AddCat(Request $request)
    {
        $validatedData = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',
            ],
            [
                'category_name.required' => 'Category name cannot be empty',
                'category_name.max' => 'Category name can only have 255 characters',
            ]
        );



        // Category::insert([
        //     'category_name' => $validatedData['category_name'],
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id =  Auth::user()->id;
        // $category->save();

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')
        ->insert($data);


        return Redirect()->back()->with('success', 'Category Successfully Inserted');
    }

    public function Edit($id){
        // $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request,$id){

        $validatedData = $request->validate(
            [
                'category_name' => 'required|max:255',
            ],
            [
                'category_name.required' => 'Category name cannot be empty',
                'category_name.max' => 'Category name can only have 255 characters',
            ]
        );


        // $update = Category::find($id)->Update(
        //     [
        //         'category_name' => $request->category_name,
        //         'user_id' => Auth::user()->id
        //     ]
        // );

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);



        return Redirect()->route('all.category')->with('success', 'Category Successfully Updated');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success', 'Category Soft Deleted');
    }

    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success', 'Category Restored');
    }

    public function PermanentDelete($id){
        $permDelete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success', 'Category Permanent Deleted');
    }
}
