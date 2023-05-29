<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;

class PostController extends Controller
{
    // Show all posts of currently authenticated user
    public function index()
    {
        // Authenticated user id
        $user_id = Auth::id();
        $posts = User::find(($user_id))->posts;
        return view('posts.index',['posts'=>$posts]);
    }

    // Show the form for creating new post
    public function createPage()
    {
        return view('posts.create');
    }

    // create new post
    public function create(Request $request)
    {
        // Get Authenticated User id
        $user_id = Auth::id();
        $post = new Post;
        $post->title = $request->input('PostTitle');
        $post->content = $request->input('PostContent');
        $post->user_id = $user_id;
        
        $image = $request->file('PostImage');
        $imageFileName = time().$image->getClientOriginalName();
        $image->move(public_path('public/Image/Posts'),$imageFileName);

        $post->image = $imageFileName;
        $post->save();

        return redirect('/posts');
    }

    // show the post for given id
    public function showPage($id) {
        $post = Post::find($id);
        $user = Auth::user();
        return view('posts.show',['post'=>$post,'user'=>$user]);
    }

    // show the form for edit post
    public function editPage($id) {
        $post = Post::find($id);
        $user = Auth::user();
        return view('posts.edit',['post'=>$post, 'user'=>$user]);
    }

    // edit post 
    public function edit(Request $request,$post_id) {

        // Retrieve Current Post Image
        $post = Post::find($post_id);
        $post_image = $post->image;
       
        $image = $request->file('PostImage');
    
        //Check if request contain any file
        if($post_image) {
            unlink(public_path('public/Image/Posts/'.$post_image));

            $imageFileName = time().$image->getClientOriginalName();
            $image->move(public_path('public/Image/Posts'),$imageFileName);

            Post::where('id',$post_id)->update([
                'title' => $request->input('PostTitle'),
                'content' => $request->input('PostContent'),
                'image' => $imageFileName
            ]);  
        }else {
            Post::where('id',$post_id)->update([
                'title' => $request->input('PostTitle'),
                'content' => $request->input('PostContent'),
            ]);
        }
        return redirect('/posts');

    }

    // delete post
    public function delete($post_id) {
        $image = Post::find($post_id);
        unlink(public_path('public/Image/Posts/'.$image->image));
        Post::find($post_id)->delete();
        return redirect('/posts');
    }


}
