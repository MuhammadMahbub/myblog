<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'meta_title', 'meta_keyword', 'yt_iframe',  'status', 'created_by',
    ];

    function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    
    function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
