<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunctionPermission extends Model
{
    public function roleFunctionPermissions()
    {
        return $this->hasMany(RoleFunctionPermission::class, 'function_permission_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function appFunction()
    {
        return $this->belongsTo(AppFunction::class, 'function_id');
    }
}
