<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'base_experience',
        'height',
        'weight',
        'sprite_url',
    ];
}

