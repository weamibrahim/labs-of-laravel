<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get("/",function(){
//     return view("welcome");
// });
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(['auth']);
Route::group(['middleware' => ['auth']],function(){

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}',[PostController::class,'destory'])->name('posts.destory');

Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show');
Route::post('/comments/{post}', [CommentController::class,'store'])->name('comments.store');

Route::delete('/comments/{post}',[CommentController::class,'destroy'])->name('comments.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
