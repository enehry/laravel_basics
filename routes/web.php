<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactFormMessageController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\MultipicController;
use App\Http\Controllers\SliderController;
use App\Models\ContactFormMessage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/email/verify', function() {
//     return view('auth.verify-email');
// })->middleware(['auth'])->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->latest()->get();
    $about = DB::table('home_abouts')->first();
    $multipics= DB::table('multipics')->latest()->get();
    return view('home', compact('brands', 'about', "multipics"));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/category/softDelete/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/permanentDelete/{id}', [CategoryController::class, 'PermanentDelete']);

// For Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

//Multi Image Route
Route::get('/multi/image', [MultipicController::class, 'Index'])->name('multi.image');
Route::post('/multi/image/store', [MultipicController::class, 'Store'])->name('multi.image.store');


Route::get('/portfolio', [HomeAboutController::class, 'Portfolio'])->name('portfolio');


// Admin Slider
Route::get('/home/slider', [SliderController::class, 'Index'])->name('home.slider');
Route::get('/slider/add', [SliderController::class, 'Add'])->name('add.slider');
Route::post('/slider/store', [SliderController::class, 'Store'])->name('store.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'Edit']);
Route::post('/slider/update', [SliderController::class, 'Update'])->name('update.slider');
Route::get('/slider/delete/{id}', [SliderController::class, 'Delete']);


// Home About Route
 
Route::get('/home/about', [HomeAboutController::class, 'Index'])->name('home.about');
Route::get('/home/about/add', [HomeAboutController::class, 'Add'])->name('add.about');
Route::post('/home/about/insert', [HomeAboutController::class, 'Insert'])->name('insert.about');
Route::get('/home/about/edit/{id}', [HomeAboutController::class, 'Edit']);
Route::post('/home/about/update/{id}', [HomeAboutController::class, 'Update']);
Route::get('/home/about/delete/{id}', [HomeAboutController::class, 'Delete']);


Route::get('admin/contact', [ContactController::class, 'Index'])->name('admin.contact');
Route::get('admin/contact/add', [ContactController::class, 'Add'])->name('admin.contact.add');
Route::post('admin/contact/store', [ContactController::class, 'Store'])->name('admin.contact.store');
Route::get('admin/contact/edit/{id}', [ContactController::class, 'Edit']);
Route::post('admin/contact/update/{id}', [ContactController::class, 'Update']);
Route::get('admin/contact/delete/{id}', [ContactController::class, 'Delete']);
Route::get('home/contact', function() {
        $contact = DB::table('contacts')->first();
        return view('layouts.pages.contact', compact('contact'));
})->name('home.contact');

Route::get('admin/contact/message', [ContactFormMessageController::class, 'Index'])->name('admin.contact.message');
Route::get('admin/contact/message/delete/{id}', [ContactFormMessageController::class, 'Delete']);
Route::post('home/contact/send_message', function(Request $request) {
    $validate = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'message' => 'required',
    ]);
   
    DB::table('contact_form_messages')->insert(
    [
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'created_at' => Carbon\Carbon::now()
    ]
    );
    return Redirect()->back()->with('success', 'Message Successfully Sent');
})->name('home.send.message');


Route::get('admin/change_pass',[ChangePasswordController::class, 'Index'])->name('admin.change_pass');
Route::post('admin/change',[ChangePasswordController::class, 'ChangePassword'])->name('admin.change');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');