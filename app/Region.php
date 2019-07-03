<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nombre',
        'sede',
        'coordinador',
        'email',
        'telefono',
        'photo_extension',
        'slug'
    ];

    protected $table = 'regions';

    public function delegaciones()
    {
        return $this->hasMany(Delegacion::class);
    }
}
