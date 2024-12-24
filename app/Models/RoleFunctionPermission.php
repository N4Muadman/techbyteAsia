<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleFunctionPermission extends Model
{
    protected $fillable = ['role_id', 'function_permission_id', 'status'];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function functionPermission()
    {
        return $this->belongsTo(FunctionPermission::class, 'function_permission_id');
    }
}
