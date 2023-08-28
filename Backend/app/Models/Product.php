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

    //image
    public const IMAGE_DEFAULT = 'image/product-default.jpg';

    public function categories()
    {
      return $this->belongsToMany(Category::class, 'product_category');
    }

    public function formatPrice($price, $currency = 'đ')
    {
      $formattedPrice = number_format($price, 0, '.', ',');
      return $formattedPrice.$currency;
    }
    
}
