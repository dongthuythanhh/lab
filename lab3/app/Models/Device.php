<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    const ACTIVE = 0;
    const INACTIVE = 1;

    protected $fillable = [
        'name',
        'serial',
        'model',
        'is_active',
        'img',
    ];
}