<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Delegacion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomenclatura_id',
        'numero',
        'sede',
        'nivel_id',
        'region_id',
        'slug'
    ];
    
    protected $table = 'delegacions';

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function nomenclatura()
    {
        return $this->belongsTo(Nomenclatura::class);
    }

    public function nivel()
    {
        return $this->belongsTo('App\Nivel');
    }    

    public function delegados()
    {
        return $this->hasMany('App\Delegado');
    } 
}
