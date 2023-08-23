<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    public const PERMISSION_ROLE_ADMIN = [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 27, 28, 29, 30, 31, 34, 35, 36, 37, 45, 46, 47, 48, 49];
    public const PERMISSION_ROLE_CTV = [3, 4, 5, 6, 7, 15, 16, 17, 18, 19, 27, 28, 29, 30, 31, 34, 35, 36, 37, 45, 46, 47, 48, 49];
    public const PERMISSION_ROLE_CUSTOMER = [8, 20, 21, 22, 23, 24, 25, 26, 32, 38, 39, 40, 41, 42, 43, 44, 50, 51, 52, 53, 54, 55, 56, 57];

    protected $fillable = [
        'module',
        'name',
        'slug'
    ];

    public $timestamps = false;

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
