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
    public function index(Request $request)
    {
        
        /*
            $delegaciones = Delegacion::paginate(20);
            $region = Region::all();
            $delegados = Delegado::where('delegacion_id',"=",$id)->get();
            return view ('admin.delegaciones.index',compact('delegaciones','region'));
            
            
            if (!$request->ajax()) return redirect('/admin');
            
            $regiones = Region::all();
            $buscar = $request->buscar;
            $criterio = $request->criterio;

            if ($buscar == '') {
                $delegaciones = Delegacion::orderBy('id','desc')->paginate(15);            
            }
            else{
                $delegaciones = Delegacion::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(15);
            }

            return [
                'pagination' => [
                    'total' => $delegaciones->total(),
                    'current_page' => $delegaciones->currentPage(),
                    'per_page' => $delegaciones->perPage(),	
                    'last_page' => $delegaciones->lastPage(),
                    'from' => $delegaciones->firstItem(),	
                    'to' => $delegaciones->lastItem()
                ], 'delegaciones' => $delegaciones,
                'regiones' => $regiones
            ];   


            SELECT 	delegacions.id as NUMERO, nomenclaturas.nomenclatura as NOMENCLATURA, delegacions.numero as NUMERO_DELEGACIONAL, 
                    delegacions.sede as SEDE, nivels.nivel_educativo as NIVEL_EDUCATIVO, regions.sede as REGION
            FROM 	delegacions
            INNER JOIN regions ON regions.id = delegacions.region_id
            INNER JOIN nomenclaturas ON nomenclaturas.id = delegacions.nomenclatura_id
            INNER JOIN nivels ON nivels.id = delegacions.nivel_id
            WHERE	regions.id = 5
        */

        if (!$request->ajax()) return redirect('/admin');
        
        $buscar = $request->buscar;
        $criterio = $request->criterio;


        if ($buscar == '') {
            $delegaciones = Delegacion::join('regions', 'regions.id', '=', 'delegacions.region_id')
                                        ->join('nomenclaturas', 'nomenclaturas.id', '=', 'delegacions.nomenclatura_id')
                                        ->join('nivels', 'nivels.id', '=', 'delegacions.nivel_id')
                                        ->select('delegacions.id as ID', 'nomenclaturas.id as NOMENCLATURA_ID','nomenclaturas.nomenclatura as NOMENCLATURA','delegacions.numero as NUMERO_DELEGACIONAL',
                                                'delegacions.sede as SEDE', 'nivels.id as NIVEL_ID', 'nivels.nivel_educativo as NIVEL_EDUCATIVO', 'regions.id as REGION_ID' ,'regions.sede as REGION','delegacions.slug as SLUG')        
                                        ->orderBy('delegacions.id','desc')
                                        ->paginate(30);
        } else {
            $delegaciones = Delegacion::join('regions', 'regions.id', '=', 'delegacions.region_id')
                                        ->join('nomenclaturas', 'nomenclaturas.id', '=', 'delegacions.nomenclatura_id')
                                        ->join('nivels', 'nivels.id', '=', 'delegacions.nivel_id')
                                        ->select('delegacions.id as ID', 'nomenclaturas.id as NOMENCLATURA_ID','nomenclaturas.nomenclatura as NOMENCLATURA','delegacions.numero as NUMERO_DELEGACIONAL',
                                                'delegacions.sede as SEDE', 'nivels.id as NIVEL_ID', 'nivels.nivel_educativo as NIVEL_EDUCATIVO', 'regions.id as REGION_ID' ,'regions.sede as REGION','delegacions.slug as SLUG')
                                        ->where('delegacions.'.$criterio, 'LIKE', '%'.$buscar.'%') 
                                        ->orderBy('delegacions.id','desc')
                                        ->paginate(30);
        }


        return [
            'pagination' => [
                'total' => $delegaciones->total(),
                'current_page' => $delegaciones->currentPage(),
                'per_page' => $delegaciones->perPage(),	
                'last_page' => $delegaciones->lastPage(),
                'from' => $delegaciones->firstItem(),	
                'to' => $delegaciones->lastItem()
            ], 'delegaciones' => $delegaciones
        ];             

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $nomenclaturas = Nomenclatura::all();
        // $niveles = Nivel::all();
        // $regiones = Region::all();
        // return view ('admin.delegaciones.create',compact('nomenclaturas','niveles','regiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
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
        */

        
        if (!$request->ajax()) return redirect('/admin');
        
        $delegacion = new Delegacion();
            
        $delegacion->nomenclatura_id  = $request->get('nomenclatura_id');
        $delegacion->numero  = $request->get('numero') ;
        $delegacion->sede  = $request->get('sede') ;
        $delegacion->nivel_id  = $request->get('nivel_id') ;
        $delegacion->region_id  = $request->get('region_id') ;        
        $valueNom = Nomenclatura::find($delegacion->nomenclatura_id);
        $delegacion->slug=$valueNom->nomenclatura.$delegacion->numero;  
        
        $delegacion->save();        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $delegacion = Delegacion::where('slug','=',$slug)->firstOrFail();
        // return view ('admin.delegaciones.show',compact('delegacion'));       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        /*
            $nomenclaturas = Nomenclatura::all();
            $niveles = Nivel::all();
            $regiones = Region::all();
            $delegacion = Delegacion::whereSlug($slug)->firstOrFail();
            return view ('admin.delegaciones.edit',compact('delegacion','nomenclaturas','niveles','regiones'));
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*
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
        */

        if (!$request->ajax()) return redirect('/admin');
        
        $delegacion = Delegacion::findOrFail($request->id);
            
        $delegacion->nomenclatura_id  = $request->get('nomenclatura_id');
        $delegacion->numero  = $request->get('numero') ;
        $delegacion->sede  = strtoupper($request->sede);
        $delegacion->nivel_id  = $request->get('nivel_id') ;
        $delegacion->region_id  = $request->get('region_id') ;        
        $valueNom = Nomenclatura::find($delegacion->nomenclatura_id);
        $delegacion->slug=$valueNom->nomenclatura.$delegacion->numero;  
        
        $delegacion->save();         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delegacion  $delegacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $delegacion = Delegacion::where('slug','=', $slug)->firstOrFail();        
        // $delegacion->delete();
        // // return back('/delegaciones')->with('borrado','La información ha sido borrada');
        // return back();

        Delegacion::find($id)->delete();
    }
}
