<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url_image',
        'product_id',
    ];
    protected $table = 'images';
    public function products(){
        return $this->hasOne('App\Models\Product','id','product_id')->where('status','active');
    }
}
