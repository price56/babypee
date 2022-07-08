<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationCode extends Model
{
    use HasFactory;

    protected $table = 'validation_code';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'code',
        'expired_at',
        'ref_id',
        'ref_type',
    ];
}
