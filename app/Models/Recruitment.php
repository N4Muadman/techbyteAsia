<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'position_job',
        'salary',
        'time',
        'quantity',
        'expiration_date',
        'content',
        'show',
    ];

    public function application(){
        return $this->hasMany(Application::class);
    }
}
