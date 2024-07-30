<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'image',
        'description',
        'condition',
        'quantity',
        'discount',
        'old_price',
        'new_price',
        'status',
    ];
    protected $table = 'products';
    public function brand(){
        return $this->hasOne(brand::class,'id','brand_id');
    }
    public function category(){
        return $this->hasOne(category::class,'id','category_id');
    }
    public function images(){
        return $this->hasMany(Image::class,'product_id','id');
    }
    // public function orderDetails(){
    //     return $this->hasMany(OrderDetail::class,'product_id','id');
    // }
    // public function comments(){
    //     return $this->hasMany(Comment::class,'product_id','id');
    // }
    // public function reviews(){
    //     return $this->hasMany(Review::class,'product_id','id');
    // }
    // public function ratings(){
    //     return $this->hasMany(Rating::class,'product_id','id');
    // }

}
