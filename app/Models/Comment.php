<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
use HasFactory;
protected $fillable = [
    'user_id', 'message', 'tweets_id'
];


    public function tweets()
    {
        return $this->belongsTo(Tweet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

