<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tweet extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }



    public function loadIsLiked()
    {
        return $this->loadCount($this->isLikedQuery());
    }

    public function isLikedQuery()
    {
        return ['likes as is_liked' => function ($query) {
            $query->where('user_id', Auth::id());
        }];
    }
    public function scopeWithIsLike($builder)
    {
        $builder->withCount($this->isLikedQuery());
    }


    public function orignalTweet()
    {
        return $this->belongsTo(Tweet::class, 'orignalTweet', 'id');
    }


    public function retweets()
    {
        return $this->hasMany(Tweet::class, 'id', 'orignalTweet');
    }


    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }



    // public function retweets()
    // {
    //     return $this->hasMany(Tweet::class, 'id');
    // }



// public function orignalTweet()
// {


// }





}
