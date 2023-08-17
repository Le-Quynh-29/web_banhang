<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
      'name',
      'phone_number',
      'address',
      'default_address',
      'user_id',
    ];

    public $timestamps = true;
}
