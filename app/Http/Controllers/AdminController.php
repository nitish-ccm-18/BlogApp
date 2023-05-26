<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\User;
use App\Models\Identitycard;

class AdminController extends Controller
{
    public function index() {
        // $users = DB::select('select * from users where user_type = "member"');
        $users = User::all()->where('user_type','member');
        return view('admin.index',['users'=>$users]);
    }


    // createUserPage
    public function createPage() {
        return view('admin.create');
    }


    // Create User
    public function create(Request $request) {

        

        $name = $request->input('UserName');
        $email = $request->input('UserEmail');
        $password = Hash::make($request->input('UserPassword'));

        $picture = $request->file('UserProfile');
       

        // Store filename as per database storage
        $filename = "";
        if($picture != "" ) {
            $filename = time().$picture->getClientOriginalName();
            $picture->move(public_path('public/Image'), $filename);
        }


        $user = new User;
        $user->name = $request->input('UserName');
        $user->email = $request->input('UserEmail');
        $user->profile_picture = $filename;
        $user->password = Hash::make($request->input('UserPassword'));
        $user->save();


        $identity = new Identitycard;
        $identity->user_id = $user->id;
        $identity->identity_number = rand(1000000,9999999);
        $identity->phone_number = rand(100000000,999999999);
        $identity->save();

      return redirect('/admin');
    }

    // View User
    public function show($id) {
        $user = DB::select('select * from users INNER JOIN identitycards ON users.id = identitycards.user_id where users.id = ?',[$id]);
        return view('admin.show',['user'=>$user]);
    }

    // Edit User Page
    public function editPage($id) {
        $user = DB::select('select * from users INNER JOIN identitycards ON users.id = identitycards.user_id where users.id = ?',[$id]);
        return view('admin.edit',['user'=>$user]);
    }

    // edit User
    public function edit(Request $request,$id) {
        $filename = "";
        if($request->file('UserProfile') ){
            // remove existing file
            $image = DB::select('select profile_picture from users where id = ?',[$id]);
            if(file_exists(public_path().'/public/Image/'.$image[0]->profile_picture) && $image[0]->profile_picture){
                unlink(public_path().'/public/Image/'.$image[0]->profile_picture);
            }
            
            $file= $request->file('UserProfile');
            $filename= time().$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
        }
        
        if($filename == "") {
            DB::update("UPDATE `users` SET `name`=?  WHERE id = ?",
            [$request->input('UserName'),$id]);

            DB::update("UPDATE `identitycards` SET `phone_number`=?  WHERE user_id = ?",
            [$request->input('UserPhone'),$id]);
        }

        else {
            DB::update("UPDATE `users` SET `name`=?, `profile_picture`= ? WHERE id = ?",
            [$request->input('UserName'),$filename,$id]);

            DB::update("UPDATE `identitycards` SET `phone_number`=?  WHERE user_id = ?",
            [$request->input('UserPhone'),$id]);
        }
        
        return redirect('/admin');
    }

    // Delete User
    public function delete($id) {
        $image = User::find($id);
            if($image->profile_picture) {
                if(file_exists(public_path().'/public/Image/'.$image->profile_picture)){
                    unlink(public_path().'/public/Image/'.$image->profile_picture);
                }
            }
            User::find($id)->delete();
            return redirect('/admin');
    }

}
