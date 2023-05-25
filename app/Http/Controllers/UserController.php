<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    // User Profile
    public function showProfile(Request $request) {
        // Get Current Authenticated User
        $user = Auth::user();

        // pass user to their views
        return view('users.profile',['user'=>$user]);
    }
}
