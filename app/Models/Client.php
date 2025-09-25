<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    // Champs que l'on peut mettre à jour via update()
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
