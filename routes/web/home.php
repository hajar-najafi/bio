<?php

use App\Http\Controllers\EventController;
use App\Mail\MailSender;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
if (Gate::allows('delete_user')){
    return 'yes';
}
return "no";

})->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('myresume', function () {
    return view('index');
})->middleware('auth');





//my resume pdf
Route::get('resume', function () {
    return view('nav.mainresume');
})->name('resume');


//about me
Route::get('about', function () {
    return view('nav.about');
})->name('about');


//contact me/send mail
Route::get('mailform',[\App\Http\Controllers\MailController::class,'mailform'])->name('mailform');

Route::post('sendmail',function (){
    Mail::to(auth()->user()->email)->send(new MailSender($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['message']));
    return back();

})->name('sendmail');

Auth::routes();




//login with google
Route::get('/auth/google',[\App\Http\Controllers\Auth\GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback',[\App\Http\Controllers\Auth\GoogleAuthController::class,'callback']);

//certificates
Route::get('/certificate',[\App\Http\Controllers\CertificateController::class,'index']);
Route::get('/edit/{certificate}',[\App\Http\Controllers\CertificateController::class,'edit']);
Route::post('/certificate/edit/{certificate}',[\App\Http\Controllers\CertificateController::class,'update']);
Route::delete('/certificate/destroy/{certificate}',[\App\Http\Controllers\CertificateController::class,'destroy']);
Route::get('/certificate/form',function (){
    return view('portfolio.form');
});
Route::post('/certificate/create',[\App\Http\Controllers\CertificateController::class,'create']);



//calendar
Route::get('calendar', [EventController::class, 'index'])->name('calendar.index');
Route::post('calendar/create-event', [EventController::class, 'create'])->name('calendar.create');
Route::patch('calendar/edit-event', [EventController::class, 'edit'])->name('calendar.edit');
Route::delete('calendar/remove-event', [EventController::class, 'destroy'])->name('calendar.destroy');




//blog post and comment
Route::get('/posts',[\App\Http\Controllers\PostController::class,'index'])->name('posts.index');
Route::get('/post/create',[\App\Http\Controllers\PostController::class,'create'])->name('posts.create');
Route::post('/post/create',[\App\Http\Controllers\PostController::class,'store'])->name('posts.store');
Route::get('/post/view/{id}',[\App\Http\Controllers\PostController::class,'show'])->name('posts.show');
Route::post('/comment/store',[\App\Http\Controllers\CommentController::class,'store'])->name('comments.store');


//profile
Route::get('/profile',[\App\Http\Controllers\profile\ProfileController::class,'index']);
Route::get('/profile/twofactor',[\App\Http\Controllers\profile\ProfileController::class,'managetwofactor']);
Route::post('/profile/twofactor',[\App\Http\Controllers\profile\ProfileController::class,'postmanagetwofactor']);
Route::get('/profile/verifytoken',[\App\Http\Controllers\profile\ProfileController::class,'verifytokenform'])->name('verifytoken');
Route::post('/profile/verifytoken',[\App\Http\Controllers\profile\ProfileController::class,'verifytoken']);

//two factor auth after login
Route::get('/tokenform',[\App\Http\Controllers\Auth\TwofactorauthController::class,'tokenform']);
Route::post('/tokenform',[\App\Http\Controllers\Auth\TwofactorauthController::class,'posttokenform']);

Route::get('/test',[\App\Http\Controllers\Auth\TwofactorauthController::class,'test']);
