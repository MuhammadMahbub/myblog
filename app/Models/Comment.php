<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['post_id', 'user_id', 'comment'];

    function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
