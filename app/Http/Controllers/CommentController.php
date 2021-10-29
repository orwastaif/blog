<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Carbon;


class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required'
        ]);

        Comment::insert([
            'user_id'=>Auth::user()->id,
            'post_id'=>$request->id,
            'text'=>$request->text,
            'created_at'=>carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Comment Added Successfully');
    }
}
