<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountVoucher extends Model
{
    use HasFactory, CustomInsertTrait;

    protected $table = 'discount_vouchers';

    public const STATUS_EXPIRED = 2;
    public const STATUS_START = 1;
    public const STATUS_END_OF_USE = 3;

    public const TYPE_MONEY = 1;
    public const TYPE_PERCENT = 2;

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

    public function customizePrefix()
    {
        return 'MGG';
    }

    public function customizeField()
    {
        return 'code';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formatType()
    {
        $stringType = 'Giảm tiền';
        if ($this->type == self::TYPE_PERCENT) {
            $stringType = 'Giảm phần trăm';
        }
        return $stringType;
    }

    public function formatStatus()
    {
        $status = 'Bắt đầu';
        if ($this->status == self::STATUS_EXPIRED) {
            $status = 'Hết hạn';
        } else if ($this->status == self::STATUS_END_OF_USE) {
            $status = 'Hết lượt sử dụng';
        }
        return $status;
    }
}
