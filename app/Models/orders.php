<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_date',
        'name',
        'email',
        'phone',
        'address',
        'messages',
        'amount',
        'payment_method',
        'payment_status',
        'status',
    ];
    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function order_details()
    {
        return $this->hasMany('App\Models\order_details','order_id','id');
    }
}
