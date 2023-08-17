<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'event',
        'user_id',
        'user_agent',
        'ip_address',
        'data',
        'created_at',
    ];

    public $timestamps = false;
}
