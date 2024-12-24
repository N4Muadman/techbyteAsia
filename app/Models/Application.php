<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'cv_path',
        'cover_letter',
        'application_date',
        'recruitment_id',
    ];

    public function recruitment(){
        return $this->belongsTo(Recruitment::class);
    }
}
