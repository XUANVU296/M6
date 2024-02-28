<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_defail extends Model
{
    use HasFactory;
    protected $table = 'order_defails';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];
}
