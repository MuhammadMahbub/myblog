<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'meta_title', 'meta_keyword', 'yt_iframe',  'status', 'created_by',
    ];

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
