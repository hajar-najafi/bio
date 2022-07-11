<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request,$user)
    {
     if (auth()->user()->twofactortype==='sms') {

         $request->session()->flash('user_id',auth()->user()->id);
         auth()->logout();
         $user=User::find($request->session()->get('user_id'));
         Token::Generatecode($user);
         //send sms
         return redirect('tokenform');


     }  else return redirect('/myresume');


    }
}
