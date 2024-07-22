<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ward extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'district_id',
    ];
    protected $table = 'ward';
}
