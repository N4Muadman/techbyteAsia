<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'name',
        'image',
        'content',
        'link',
        'category_id',
    ];
    public function category(){
        return $this->belongsTo(PortfolioCategory::class);
    }
}
