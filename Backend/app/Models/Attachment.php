<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';

    protected $fillable = [
        'name',
        'ext',
        'size',
        'path',
        'type',
        'pos',
        'entity_type',
        'entity_id',
        'user_id',
    ];

    public $timestamps = true;
}
