<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Định nghĩa mối quan hệ thông qua bảng Order đến bảng Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'order_id', 'id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
