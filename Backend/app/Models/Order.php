<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'user_id',
        'name',
        'phone_number',
        'address',
        'total',
        'status',
        'transaction_time',
        'delivery_time',
        'received_time',
        'cancellation_time',
        'note_cancle',
        'note',
        'payment_method',
        'account_holder',
        'account_number',
        'bank',
        'transfer_note',
        'voucher_id'
    ];

    public $timestamps = true;
}
