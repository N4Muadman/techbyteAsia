<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    public function employee(){
        return $this->hasOne(Employee::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($functionId, $permissionId)
    {
        if ($this->role_id == 1) {
            return true;
        }
        return $this->role
            ->functionPermissions()
            ->where('function_id', $functionId)
            ->where('permission_id', $permissionId)
            ->wherePivot('status', 1)
            ->exists();
    }
    public function hasPermissions($functionId, $permissionIds)
    {
        if ($this->role_id == 1) {
            return true;
        }
        return $this->role
            ->functionPermissions()
            ->where('function_id', $functionId)
            ->whereIn('permission_id', $permissionIds)
            ->wherePivot('status', 1)
            ->exists();
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
