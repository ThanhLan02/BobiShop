<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'amount',
    ];
    protected $table = 'carts';
    public function products(){
        return $this->belongsTo('App\Models\product','product_id','id');
    }
    public function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}

