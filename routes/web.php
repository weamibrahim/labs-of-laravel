<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;

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



Route::get('/auth/redirect', function ()
 {
    return Socialite::driver('github')->redirect();
 })->name('login.githup');

Route::get('/auth/callback', function () {

   $githubUser = Socialite::driver('github')->stateless()->user();
   $existingUser = User::where('email', $githubUser->getEmail())->first();
   if ($existingUser) 
   {
       Auth::login($existingUser);
      
   }
   else{
//dd($githubUser);

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'password'=>bcrypt('default_password'),
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);
}
    return redirect('/posts');
    // dd($user);
});



Route::get('/login/google', function ()
{
    return Socialite::driver('google')->redirect();
 })->name('login.google');

Route::get('/login/google/callback', function () {

   $emailUser = Socialite::driver('google')->stateless()->user();
//dd($emailUser);

$existingUser = User::where('email', $emailUser->getEmail())->first();
if ($existingUser) 
{
   
    Auth::login($existingUser);
   
}
else{
    $user = User::updateOrCreate([
        'github_id' => $emailUser->id,
    ], [
        'name' => $emailUser->name,
        'email' => $emailUser->email,
        'password' => bcrypt('default_password'),
        'google_token' => $emailUser->token,
        'google_refresh_token' => $emailUser->refreshToken,
    ]);


    Auth::login($user);
}
    return redirect('/posts');
    // dd($user);
});