<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'website_name', 'web_logo', 'fav_icon', 'description', 'meta_description', 'meta_title', 'meta_keyword'
    ];
}
