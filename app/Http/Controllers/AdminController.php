<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\User;
use App\Models\Identitycard;

class AdminController extends Controller
{
    // List all users
    public function index() {
        $users = User::all()->where('user_type','member');
        return view('admin.index',['users'=>$users]);
    }


    // createUserPage
    public function createPage() {
        return view('admin.users.create');
    }


    // Create User
    public function create(Request $request) {

        $picture = $request->file('UserProfile');

        // Store filename as per database storage
        $filename = "";
        if($picture != "" ) {
            $filename = time().$picture->getClientOriginalName();
            $picture->move(public_path('public/Image/Users'), $filename);
        }

        // Save user values to users table
        $user = new User;
        $user->name = $request->input('UserName');
        $user->email = $request->input('UserEmail');
        $user->profile_picture = $filename;
        $user->password = Hash::make($request->input('UserPassword'));
        $user->save();

        // Save identity card values to their table
        $identity = new Identitycard;
        $identity->user_id = $user->id;
        $identity->identity_number = rand(1000000,9999999);
        $identity->phone_number = rand(100000000,999999999);
        $identity->save();

        return redirect('/admin');
    }

    // View User
    public function show($id) {
        $user = User::find($id);
        $identitycard = $user->identitycard;
        return view('admin.users.show',['user'=>$user, 'identitycard'=>$identitycard]);   
    }

    // Edit User Page
    public function editPage($id) {
        $user = User::find($id);
        $identitycard = $user->identitycard;
        return view('admin.users.edit',['user'=>$user, 'identitycard'=>$identitycard]);
    }

    // edit User
    public function edit(Request $request,$id) {
        $filename = "";

        if($request->file('UserProfile')){
            // remove existing file
            $image =  User::find($id);;
            if(file_exists(public_path().'/public/Image/Users/'.$image->profile_picture) && $image->profile_picture){
                unlink(public_path().'/public/Image/Users/'.$image->profile_picture);
            }
            
            $file= $request->file('UserProfile');
            $filename= time().$file->getClientOriginalName();
            $file-> move(public_path('public/Image/Users'), $filename);
        }

        $name = $request->input('UserName');
        $phone = $request->input('UserPhone');

        if($filename == "") {
            User::where('id',$id)->update([
                 'name' => $name
            ]);

            Identitycard::where('user_id',$id)->update([
                'phone_number' => $phone
            ]);
        }
        else {
            User::where('id',$id)->update([
                 'name' => $name,
                 'profile_picture' => $filename
            ]);

            Identitycard::where('user_id',$id)->update([
                'phone_number' => $phone
            ]);
        }
        return redirect('/admin');
    }

    // Delete User
    public function delete($id) {
        $image = User::find($id);
            if($image->profile_picture) {
                if(file_exists(public_path().'/public/Image/Users'.$image->profile_picture)){
                    unlink(public_path().'/public/Image/Users'.$image->profile_picture);
                }
            }
            User::find($id)->delete();
            return redirect('/admin');
    }

}


