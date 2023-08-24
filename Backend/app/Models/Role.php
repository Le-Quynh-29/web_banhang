<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'name'
    ];

    public $timestamps = true;

    public static function selects() {
        return self::select('id', 'name')->get();
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function checkDisablePermission($permissionId)
    {
        $class = '';
        if ($this->id == User::ROLE_CUSTOMER && !in_array($permissionId, Permission::PERMISSION_ROLE_CUSTOMER)) {
            $class = 'disable-checkbox';
        } elseif ($this->id != User::ROLE_CUSTOMER && in_array($permissionId, Permission::PERMISSION_ROLE_CUSTOMER)) {
            $class = 'disable-checkbox';
        }
        return $class;
    }
}
