<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class UserController extends Controller
{
    // User Profile
    public function showProfile(Request $request) {
        // Get Current Authenticated User
        $user = Auth::user();

        // pass user to their views
        return view('users.profile',['user'=>$user]);
    }

    // Get Edit Profile Page
    public function editProfilePage() {
        // Get Current Authenticated User
        $user = Auth::user();

        // pass user to their views
        return view('users.edit',['user'=>$user]);
    }

    // Edit Profile
    public function editProfile(Request $request) {
        // Get Current Authenticated User id
        $user_id = Auth::id();

        // Get data from html form
        $name = $request->input('UserName');
        $picture = $request->file('UserProfile');
       

        // Store filename as per database storage
        $filename = "";
        if($picture != "" ) {
            $filename = time().$picture->getClientOriginalName();
            $picture->move(public_path('public/Image'), $filename);
            $user = DB::update('update users set name = ?, profile_picture = ? where id = ?',[$name,$filename,$user_id]);

            return redirect('/users/profile');
            
        }
        // If no image recieved
        DB::update('update users set name = ? where id = ?',[$name,$user_id]);
        // return redirect('/users/profile');


    }
}
