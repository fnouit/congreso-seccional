<?php

namespace App\Http\Controllers;

use App\Delegacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Region;
use App\Nomenclatura;
use App\Nivel;

class DelegacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegaciones = Delegacion::paginate(20);
        
        $region = Region::all();

        // $delegados = Delegado::where('delegacion_id',"=",$id)->get();

        return view ('admin.delegaciones.index',compact('delegaciones','region'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomenclaturas = Nomenclatura::all();
        $niveles = Nivel::all();
        $regiones = Region::all();
        return view ('admin.delegaciones.create',compact('nomenclaturas','niveles','regiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje =[
            'numero.required' => 'Es necesario ingresar un numero en el campo NÚMERO DELEGACIONAL.',
            'numero.numeric' => 'El campo NÚMERO DELEGACIONAL no tiene que contener texto.',
            'sede.required' => 'Es necesario ingresar un nombre en el campo SEDE.'
        ];

        $reglas = [
            'numero' => 'required|numeric',
            'sede' => 'required'
        ];
        $this->validate($request, $reglas, $mensaje);


        $delegacion = new Delegacion();
        
        $delegacion->nomenclatura_id = $request->get('nomenclatura');
        $delegacion->numero = $request->input('numero');
        $delegacion->sede = $request->input('sede');
        $delegacion->nivel_id = $request->get('nivel');
        $delegacion->region_id = $request->get('region');
        
        $valueNom = Nomenclatura::find($delegacion->nomenclatura_id);
        $delegacion->slug=$valueNom->nomenclatura.$delegacion->numero;
        
        $delegacion->save();

        return redirect('/delegaciones')->with('success_create','La delegación '.$delegacion->nomenclatura->nomenclatura.$delegacion->numero.' se CREADO satisfactoriamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $delegacion = Delegacion::where('slug','=',$slug)->firstOrFail();
        return view ('admin.delegaciones.show',compact('delegacion'));       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $nomenclaturas = Nomenclatura::all();
        $niveles = Nivel::all();
        $regiones = Region::all();
        $delegacion = Delegacion::whereSlug($slug)->firstOrFail();
        return view ('admin.delegaciones.edit',compact('delegacion','nomenclaturas','niveles','regiones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $delegacion = Delegacion::where('slug','=', $slug)->firstOrFail();
        $delegacion->nomenclatura_id = $request->get('nomenclatura');
        $delegacion->numero = $request->input('numero');
        $delegacion->sede = $request->input('sede');
        $delegacion->nivel_id = $request->get('nivel');
        $delegacion->region_id = $request->get('region');        

                
        $valueNom = Nomenclatura::find($delegacion->nomenclatura_id);
        $delegacion->slug=$valueNom->nomenclatura.$delegacion->numero;


        $delegacion->save();

        // return redirect()->route('mostrar.delegacion', [$delegacion->slug]);
        // return back(URL::('del'))->with('success', 'Actualización echa');
       return redirect(route('ver.delegaciones'))->with('success', 'Actualización echa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $delegacion = Delegacion::where('slug','=', $slug)->firstOrFail();        
        $delegacion->delete();
        // return back('/delegaciones')->with('borrado','La información ha sido borrada');
       return back();
    }
}
