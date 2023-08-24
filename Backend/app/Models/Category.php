<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory, CustomInsertTrait;

  protected $table = 'categories';

  protected $fillable = [
    'code',
    'name',
    'slug',
    'user_id',
    'image',
  ];

  public $timestamps = true;

  public function customizePrefix(){
    return 'C';
  }

  public function customizeField(){
      return 'code';
  }

  public function user(){
      return $this->belongsTo(User::class, 'user_id');
  }

  public function formatDate($date){
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

}
