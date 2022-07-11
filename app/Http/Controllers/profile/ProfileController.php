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
        $data=$request->validate([
            'type'=>'required',
            'phone'=>'required_unless:type,off',
            ]);


        if ($request['type'] === "off") {
            auth()->user()->update(['twofactortype' => 'off']);
            return redirect('/myresume');
        }elseif ($request['phone']){

        //Todo send sms
        //generatecode & save code to data base
        Token::generatecode($request->user());
        $request->session()->flash('phone',$request['phone']);
        return redirect(route('verifytoken'));
        }else{
            return redirect('/profile/twofactor');
        }


    }

    public function verifytokenform(Request $request)
    {
        $request->session()->reflash();
        return view('profile.tokenform');
    }

    public function verifytoken(Request $request)
    {

        $token=$request->user()->tokens->where('token',$request['token'])->where('expire','>',now())->first();
        if ($token){
            $request->user()->update(['twofactortype'=>'sms','phonenumber'=>$request->session()->get('phone')]);
            $request->user()->tokens()->delete();
            return redirect('/profile')->with('alert', 'Updated');
        }else{
            return redirect('/profile/verifytoken');

        }

    }



}







