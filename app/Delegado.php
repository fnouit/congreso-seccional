<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegado extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'delegacion_id',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'genero_id',
        'rfc',
        'estudio_id',
        'situacion_id',
        'email',
        'telefono',
        'facebook',
        'twitter',
        'seccion',
        'estado',
        'imagen'    
    ];

    protected $table = 'delegados';

    public function estudio()
    {
        return $this->belongsTo('App\Estudio');
    } 

    public function genero()
    {
        return $this->belongsTo('App\Genero');
    } 

    public function situacion()
    {
        return $this->belongsTo('App\Situacion');
    } 

    public function delegacion() 
    {
        return $this->belongsTo('App\Delegacion');
    }    

    public function user() 
    {
        return $this->belongsTo('App\User');
    }   

}
