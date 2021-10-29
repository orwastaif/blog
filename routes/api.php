<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CategoryController;

use App\Models\Post;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', [Authcontroller::class, 'login'])->name('login');
Route::get('/registration', [Authcontroller::class, 'registration'])->name('registration');
Route::post('/register-user', [Authcontroller::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [Authcontroller::class, 'loginUser'])->name('login-user');
Route::get('/logout', [Authcontroller::class, 'logout'])->name('logout');

Route::get('/forgotpassword', [Authcontroller::class, 'forgotPassword'])->name('forgotpassword');
Route::post('/resetpassword', [Authcontroller::class, 'resetPassword'])->name('resetpassword');

Route::get('/posts', [PostController::class, 'showPost'])->name('Add_post');
Route::post('/add/posts', [PostController::class, 'addPost'])->name('Add_post1');
Route::get('/myposts', [PostController::class, 'listPosts'])->name('list-posts');

Route::get('/edit/{id}', [PostController::class, 'editPost'])->name('post.edit');
Route::post('/post/update', [PostController::class, 'updatePost'])->name('post.update');
Route::get('/delete/post/{id}', [PostController::class, 'deletePost'])->name('post.delete');
Route::get('/all/posts', [PostController::class, 'allPosts'])->name('all.posts');

Route::post('/posts/comments/{id}', [CommentController::class, 'createComment'])->name('create.comment');

Route::get('/liked/{id}', [LikesController::class, 'likePost'])->name('liked');
Route::get('/disliked/{id}', function($id){
    $post = DB::table('likes')->where('post_id', $id)->delete();
    return back()->with('fail', 'You do not like this post');
})->name('disliked');

Route::get('/posts/category1', [CategoryController::class, 'category1'])->name('category1');
Route::get('/posts/category2', [CategoryController::class, 'category2'])->name('category2');
Route::get('/posts/category3', [CategoryController::class, 'category3'])->name('category3');





