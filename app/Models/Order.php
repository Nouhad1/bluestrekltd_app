<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'client_id', 'name', 'email', 'phone', 'address',
        'product_title', 'product_id', 'quantity', 'price',
        'total_price', 'delivery_status', 'payment_status', 'image'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_reference', 'reference');
    }
}
