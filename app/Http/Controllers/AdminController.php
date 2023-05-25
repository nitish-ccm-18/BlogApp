<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class AdminController extends Controller
{
    public function index() {
        $users = DB::select('select * from users where user_type = "member"');
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
            $filename = date('YmdHi').$picture->getClientOriginalName();
            $picture->move(public_path('public/Image'), $filename);
        }

        DB::insert("INSERT INTO `users`(`name`, `email`,`profile_picture`, `password`) VALUES (?,?,?,?)",
        [$request->input('UserName'),$request->input('UserEmail'),$filename,$password]);

        return redirect('/admin');
    }

    // View User
    public function show($id) {
        $user = DB::select('select *  from users where id = ?',[$id]);
        return view('admin.show',['user'=>$user]);
    }

    // Edit User Page
    public function editPage($id) {
        $user = DB::select('select *  from users where id = ?',[$id]);
        return view('admin.edit',['user'=>$user]);
    }

    // edit User
    public function edit(Request $request,$id) {
        $filename = "";
        if($request->file('UserProfile')){
            // remove existing file
            $image = DB::select('select profile_picture from users where id = ?',[$id]);
            if(file_exists(public_path().'/public/Image/'.$image[0]->profile_picture)){
                unlink(public_path().'/public/Image/'.$image[0]->profile_picture);
            }
            
            $file= $request->file('UserProfile');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
        }
        
        if($filename == "")
            DB::update("UPDATE `users` SET `name`=?  WHERE id = ?",
            [$request->input('UserName'),$id]);
        else
            DB::update("UPDATE `users` SET `name`=?, `profile_picture`= ? WHERE id = ?",
            [$request->input('UserName'),$filename,$id]);
        
        return redirect('/admin');
    }

    // Delete User
    public function delete($id) {
        $image = DB::select('select profile_picture from users where id = ?',[$id]);
        
        if($image[0]->profile_picture) {
            if(file_exists(public_path().'/public/Image/'.$image[0]->profile_picture)){
                unlink(public_path().'/public/Image/'.$image[0]->profile_picture);
            }
            DB::delete('delete from users where id = ?',[$id]);
            
        }
        return redirect('/admin');
    }

}
