<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'reference';   // clé primaire
    public $incrementing = false;          // car ce n’est pas un entier auto-incrémenté
    protected $keyType = 'string';         // type string (VARCHAR)

    protected $fillable = [
        'reference',
        'description',
        'image',
        'id_category',
        'quantity',
        'price',
        'discount_price',
    ];

    // Relation avec Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function ficheTechnique()
{
    return $this->hasOne(FicheTechnique::class, 'product_reference', 'reference');
}

public function orders()
{
    return $this->hasMany(Order::class, 'product_id');
}

}
