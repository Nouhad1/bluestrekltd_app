<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    // Indiquer le nom exact de la table
    protected $table = 'catagories';

    protected $fillable = [
        'catagory_name',
    ];

    // Relation : une catégorie contient plusieurs produits
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}
