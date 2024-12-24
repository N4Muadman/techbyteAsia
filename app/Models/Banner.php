<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['image_path', 'status'];

    public function getStatusLableAttribute()
    {
        $statuses = [
            0 => '<span class="text-danger">Inactive</span>',
            1 => '<span class="text-info">Active</span>'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
