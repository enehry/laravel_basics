<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    //
    public function Index(){
        return view('admin.body.change_pass');
    }

    public function ChangePassword(Request $request){
        $validation = $request
        ->validate(
            [
                'old_password' => 'required',
                'password' => 'required|min:8|confirmed|different:old_password',
                'password_confirmation' => 'required'
            ]
        );

        $hashPass = Hash::make($request->password);
        
        if (Hash::check($request->old_password, Auth::user()->password)){
            $user = User::find(Auth::id())->update(
                [
                    'password' => $hashPass,
                    'updated_at' => Carbon::now()
                ]
            );
            
            Auth::logout();
            return Redirect()->route('login')->with('status', 'Password successfully change please login again');
        } else {
            return Redirect()->back()->with('error', 'Old password do not match with your existing password');
        }
                
    }
}
