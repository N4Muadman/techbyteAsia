<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'status'];

    public function roleFunctionPermissions()
    {
        return $this->hasMany(RoleFunctionPermission::class, 'role_id');
    }
    public function users() {
        return $this->hasMany(User::class);
    }

    public function functionPermissions()
    {
        return $this->belongsToMany(
            FunctionPermission::class,
            'role_function_permissions',
            'role_id',
            'function_permission_id'
        )->withPivot('status', 'id');
    }
}
