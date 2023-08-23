<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    public const SEARCH_DM = 'danh mục';
    public const SEARCH_DH = 'đơn hàng';
    public const SEARCH_MGG = 'mã giảm giá';
    public const SEARCH_SP = 'sản phẩm';

    protected $fillable = [
        'event',
        'user_id',
        'user_agent',
        'ip_address',
        'data',
        'created_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formatDate($date)
    {
        if (is_null($date)) {
            $timeFormat = null;
        } else {
            if (is_string($date)) {
                $date = strtotime($date);
                $timeFormat = date('d/m/Y H:i:s', $date);
            } else {
                $timeFormat = $date->format('d/m/Y H:i:s');
            }
        }
        return $timeFormat;
    }
}
