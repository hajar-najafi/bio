<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['title','body'];
    use HasFactory;
    /*
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    */
//in
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }






    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
