<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Composer\Autoload\includeFile;

class TwofactorauthController extends Controller
{
    public function tokenform(Request $request)
    {
        $request->session()->reflash();
        return view('auth.tokenform');
    }

    public function posttokenform(Request $request)
    {
        $data=$request->validate(['token'=>'required']);

        $user=User::find($request->session()->get('user_id'));

        $token=$user->tokens->where('token',$request['token'])->where('expire','>',now())->first();
        if ($token){
            Auth::loginUsingId($request->session()->get('user_id'));
            $user->tokens()->delete();
            return redirect('/myresume');
        }else{
            return redirect(route('login'));
        }
    }

    public function test(Request $request)
    {
        $a=$request->session()->start();
        dd($request->session()->all());
    }
}
