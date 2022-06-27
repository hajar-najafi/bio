<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class GoogleAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $google_user=Socialite::driver('google')->user();
        $user=User::where('email', $google_user->getEmail())->first();
        if ($user){
           auth()->loginUsingId($user->id);
        }else{
        $user1 = User::Create([
            'name' => $google_user->name,
            'email' => $google_user->email,
            'password' => bcrypt('12swedfh'),
        ]);
        auth()->loginUsingId($user1->id);
        }
        return redirect('/home');
    }
}
