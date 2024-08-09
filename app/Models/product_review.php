<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'rate',
        'review',
        'status',
    ];
    protected $table = 'product_reviews';
    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
