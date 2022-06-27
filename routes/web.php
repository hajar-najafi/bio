<?php

use App\Mail\MailSender;
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

    return view('welcome');
});

Route::get('myresume', function () {
    return view('index');
})->middleware('auth');






Route::get('resume', function () {
    return view('nav.mainresume');
})->name('resume');

Route::get('about', function () {
    return view('nav.about');
})->name('about');

Route::get('mailform',[\App\Http\Controllers\MailController::class,'mailform'])->name('mailform');

Route::post('sendmail',function (){
    Mail::to(auth()->user()->email)->send(new MailSender($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['message']));
    return back();

})->name('sendmail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth/google',[\App\Http\Controllers\Auth\GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback',[\App\Http\Controllers\Auth\GoogleAuthController::class,'callback']);


Route::get('/certificate',[\App\Http\Controllers\CertificateController::class,'index']);
Route::get('/edit/{certificate}',[\App\Http\Controllers\CertificateController::class,'edit']);
Route::post('/certificate/edit/{certificate}',[\App\Http\Controllers\CertificateController::class,'update']);
Route::delete('/certificate/destroy/{certificate}',[\App\Http\Controllers\CertificateController::class,'destroy']);
Route::get('/certificate/form',function (){
    return view('portfolio.form');
});

