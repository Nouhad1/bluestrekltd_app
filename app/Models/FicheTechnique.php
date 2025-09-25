<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheTechnique extends Model
{
    use HasFactory;

    protected $table = 'fiche_technique';

    protected $fillable = [
        'product_reference',
        'longueur',
        'largeur',
        'profondeur',
        'colors',
    ];

    // Convertir JSON en tableau automatiquement
    protected $casts = [
        'colors' => 'array',
    ];

    // Relation avec le produit
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_reference', 'reference');
    }
}
