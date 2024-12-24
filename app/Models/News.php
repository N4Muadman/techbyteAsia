<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'short_content',
        'content',
        'tags',
        'category',
        'user_id',
        'show',
        'image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
