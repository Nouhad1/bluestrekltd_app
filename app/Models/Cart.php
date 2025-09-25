<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'client_id',
        'product_reference', 'unit_price', 'quantity', 'total', 'image'
    ];
}
