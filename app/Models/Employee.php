<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'address',
        'phone_number',
        'position',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
