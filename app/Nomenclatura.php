<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomenclatura extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nomenclatura',
        'slug'
    ];

    protected $table = 'nomenclaturas';

    public function delegaciones()
    {
        return $this->hasMany(Delegacion::class);
    }
}
