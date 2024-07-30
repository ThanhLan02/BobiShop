<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'amount',
    ];
    protected $table = 'order_details';
    public function products(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function orders(){
        return $this->belongsTo(orders::class, 'order_id','id');
    }
}
