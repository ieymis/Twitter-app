<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // ->withTimestamps()
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tweets()
    {
        return $this->hasMany(Tweet::class, 'user_id');
    }


    public function followings()
    {
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'following_id')->withTimestamps();
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'followings', 'following_id', 'user_id')->withTimestamps();
    }

    // public function likedtweets(){
    //     return $this->belongsToMany(Tweet::class, 'likes')->withPivot('is_dislike')->withTimestamps();
    // }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


}


