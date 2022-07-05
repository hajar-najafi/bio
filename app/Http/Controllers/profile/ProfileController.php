<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function managetwofactor()
    {
        return view('profile.two_factor_auth');
    }

    public function postmanagetwofactor(Request $request)
    {


        if ($request['type'] === "off") {
            auth()->user()->update(['twofactortype' => 'off']);
            return redirect('/myresume');
        }

        auth()->user()->update(['twofactortype' => 'sms']);
        //Todo send sms
        //generatecode & save code to data base
        Token::generatecode();
        $request->session()->flash('phone',$request['phone']);
        return redirect(route('verifytoken'));


    }

    public function verifytokenform(Request $request)
    {
        $request->session()->reflash();
        return view('profile.tokenform');
    }

    public function verifytoken(Request $request)
    {
        dd( $request->session()->get('phone'));

        $token=$request->user()->tokens->where('token',$request['token'])->where('expire','>',now())->first();

    }


}







