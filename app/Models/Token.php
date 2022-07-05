<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $timestamps=false;
    use HasFactory;
    protected $fillable=[
        'user_id',
        'token',
        'expire',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGeneratecode($query)
    {
        $result = $this->checkcode();
        if ($result){
            return $result;
        }else{
            $code = mt_rand(100000, 999999);

            //save code to db
            auth()->user()->tokens()->create(['token'=>$code,'expire'=>now()->addMinute(10)]);

        }

    }

    public function checkcode()
    {

        if($result = auth()->user()->tokens->where('expire', '>', now())->first()){
            return $result->token;
        }else{
            return false;
        }
    }
}
