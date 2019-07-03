<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegacion extends Model
{
    use SoftDeletes;

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
        'slug',
        'deleted_at'
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
