<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;


class LikesController extends Controller
{
    public function likePost($id)
    {
        $user_id = Auth::user()->id;
        $post_id = $id;
        $like = new Like();
        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $like->like = 1;
        $like->save();
        return Redirect()->back()->with('success', 'You liked the post');
    }
}
