<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'date',
        'total_amount',
        'order_status',
        'product_id'
    ];
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }
}
