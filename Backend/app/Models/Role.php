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
}