<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;



class PostController extends Controller
{
    public function showPost()
    {
        return view('Add-Post');
    }
    
    public function addPost(Request $request)
    {
        $validated = $request->validate(
        [
            'Description' => 'required|max:500',
            'category' => 'required',
            'photo' => 'required|mimes:jpg,png|max:20000',
        ],
        [
            'photo.uploaded' => 'Please Upload jpg or png format',
            'photo.max' => 'Please enter a file less than 20mb',

        ]);

            $image = $request->file('photo');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(917,1000)->save('image/Posts/'.$name_gen);

            $save_url = 'image/Posts/'.$name_gen;

            Post::insert([
            'user_id'=>Auth::user()->id,
            'Description'=>$request->Description,
            'category'=>$request->category,
            'photo'=> $save_url,
            'created_at'=>carbon::now()
        ]);
        return Redirect()->back()->with('success', 'Post Added Successfully');
    }

    public function listPosts()
    {
        $posts = Post::latest()->get();
        return view('list-posts', compact('posts'));
    }

    public function editPost($id)
    {
        $posts = Post::findorFail($id);
        return view('post-edit', compact('posts'));
    }

    public function deletePost($id)
    {
        $image = Post::find($id);
        $old_image = $image->photo;
        unlink($old_image);

        Post::find($id)->delete();
        return Redirect()->back()->with('success' , 'Post Deleted Successfully');
    }

    public function updatePost(Request $request)
    {
        $validated = $request->validate(
            [
                'Description' => 'required|max:500',
                'category' => 'required',
                'photo' => 'mimes:jpg,png|max:20000',
            ],
            [
                'photo.uploaded' => 'Please Upload jpg or png format',
                'photo.max' => 'Please enter a file less than 20mb',
            ]);

                $post_id = $request->id;
                $old_img = $request->old_image;
    
            if($request->file('photo'))
            {
                unlink($old_img);
                $image = $request->file('photo');
    
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(917,1000)->save('image/Posts/'.$name_gen);
    
                $save_url = 'image/Posts/'.$name_gen;
    
                Post::findOrFail($post_id)->update(
                    [
                        'user_id'=>Auth::user()->id,
                        'Description'=>$request->Description,
                        'category'=>$request->category,
                        'photo'=> $save_url,
                        'updated_at'=>carbon::now()
                    ]);
                    return Redirect()->back()->with('success', 'Post Updated Successfully');
            }else{
                Post::findOrFail($post_id)->update(
                    [
                        'user_id'=>Auth::user()->id,
                        'Description'=>$request->Description,
                        'category'=>$request->category,
                        'updated_at'=>carbon::now()
                    ]);
                    return Redirect()->route('list-posts')->with('success' , 'Post Updated Successfully');
                }
    }

    public function allPosts()
    {
        $posts = Post::query()->get();
        $comments = Comment::query()->get();
        $likes = Like::query()->get();
        return view('posts', compact('posts', 'comments', 'likes'));
    }

    

}
