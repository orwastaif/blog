<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class CategoryController extends Controller
{
    public function category1()
    {
        $posts = Post::query()->where('category', 'category 1')->get();
        $comments = Comment::query()->get();
        $likes = Like::query()->get();

        return view('category1', compact('posts', 'comments', 'likes'));
    }

    public function category2()
    {
        $posts = Post::query()->where('category', 'category 2')->get();
        $comments = Comment::query()->get();
        $likes = Like::query()->get();

        return view('category2', compact('posts', 'comments', 'likes'));
    }

    public function category3()
    {
        $posts = Post::query()->where('category', 'category 3')->get();
        $comments = Comment::query()->get();
        $likes = Like::query()->get();

        return view('category3', compact('posts', 'comments', 'likes'));
    }
}
