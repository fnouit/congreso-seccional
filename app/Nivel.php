<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nivel extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nivel_educativo',
        'slug'
    ];
    protected $table = 'nivels';

    public function delegaciones()
    {
        return $this->hasMany('App\Delegacion');
    }  
}
