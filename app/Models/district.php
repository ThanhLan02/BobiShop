<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'province_id',
    ];
    protected $table = 'district';
}
