<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    //gender
    public const FEMALE = 0;
    public const MALE = 1;
    public const OTHER_GENDER = 2;

    //role
    public const ROLE_ADMIN = 1;
    public const ROLE_CUSTOMER = 2;

    //active
    public const NO_ACTIVE = 0;
    public const ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'gender',
        'birthday',
        'phone_number',
        'role',
        'active',
        'password',
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function formatDate($date)
    {
        if (is_null($date)) {
            $timeFormat = null;
        } else {
            if (is_string($date)) {
                $date = strtotime($date);
                $timeFormat = date('d/m/Y', $date);
            } else {
                $timeFormat = $date->format('d/m/Y');
            }
        }
        return $timeFormat;
    }

    public function convertRole($role){
        switch ($role) {
            case self::ROLE_ADMIN:
                $role = "Quản trị viên";
                break;
            case self::ROLE_CUSTOMER:
                $role = "Khách hàng";
                break;
            default:
                $role = "";
                break;
        }
        return $role;
    }
    public function convertStatus($status){
        switch ($status) {
            case self::ACTIVE:
                $status = "<p class='cl-green'>Đã kích hoạt</p>";
                break;
            case self::NO_ACTIVE:
                $status = "<p class='cl-red'>Vô hiệu hóa</p>";
                break;
            default:
                $status = "";
                break;
        }
        return $status;
    }
}
