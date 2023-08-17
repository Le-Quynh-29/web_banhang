<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
      'code',
      'name',
      'plug',
      'details',
      'description',
      'like',
      'buy',
      'view',
      'price_from',
      'price_to',
      'user_id',
      'image',
    ];

    public $timestamps = true;
}
