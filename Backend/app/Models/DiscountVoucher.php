<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountVoucher extends Model
{
    use HasFactory;

    protected $table = 'discount_vouchers';

    protected $fillable = [
        'code',
        'name',
        'type',
        'description',
        'quantity',
        'quantity_used',
        'start_time',
        'end_time',
        'user_id',
    ];

    public $timestamps = true;
}
