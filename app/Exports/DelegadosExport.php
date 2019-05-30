<?php

namespace App\Exports;

use App\Delegado;
use App\Region;
use App\Delegacion;
use App\Genero;
use App\Situacion;
use App\Estudio;
use App\Nomenclatura;
use App\Nivel;



// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exporttable;





// class DelegadosExport implements FromCollection
class DelegadosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
/*     public function collection()
    {
        return Delegado::all();
    } */

    public function view(): View
    {

        $regiones = Region::all();
        $delegaciones = Delegacion::all();
        $generos = Genero::all();
        $situaciones = Situacion::all();
        $estudios = Estudio::all();
        $nomenclaturas = Nomenclatura::all();
        $niveles = Nivel::all();
        $delegados = Delegado::all();

        return view('admin.delegados.excel',compact('delegados','regiones','delegaciones','generos','situaciones','estudios','nomenclaturas','niveles'));
        




        // return view('admin.delegados.excel');
    }
}
