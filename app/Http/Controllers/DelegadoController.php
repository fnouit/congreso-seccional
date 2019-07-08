<?php

namespace App\Http\Controllers;

use App\Delegado;
use App\Region;
use App\Delegacion;
use App\Genero;
use App\Situacion;
use App\Estudio;
use App\Nomenclatura;
use App\Nivel;
use Illuminate\Http\Request;
use App\Exports\DelegadosExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exporttable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DelegadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
            $delegados = Delegado::all();
            $regiones = Region::all();
            $delegaciones = Delegacion::all();     
            $generos = Genero::all();   
            $situaciones = Situacion::all();
            $estudios = Estudio::all();
            $nomenclaturas = Nomenclatura::all();
            $niveles = Nivel::all();

            return view ('admin.delegados.index',compact('delegados','delegaciones','regiones','nomenclaturas'));

            SELECT  regions.nombre as nomRegion, regions.sede, delegacions.slug, delegados.nombre, delegados.ap_paterno, delegados.ap_materno, generos.genero, delegados.rfc, 
                    estudios.maximo_estudio, situacions.estado_civil, delegados.email, delegados.telefono, delegados.facebook, delegados.twitter
                    FROM delegados
                    
                    INNER JOIN delegacions ON delegacions.id = delegados.delegacion_id
                    INNER JOIN generos ON generos.id = delegados.genero_id
                    INNER JOIN estudios ON estudios.id = delegados.estudio_id
                    INNER JOIN situacions ON situacions.id = delegados.situacion_id
                    INNER JOIN regions ON regions.id = delegacions.region_id
                    WHERE delegacions.id = 153            
        */

        // if (!$request->ajax()) return redirect('/admin');
        
        $buscar = $request->buscar;
        $criterio = $request->criterio;


        if ($buscar == '') {
            $delegados = Delegado::join('delegacions' , 'delegacions.id', '=', 'delegados.delegacion_id')
                                        ->join('generos' , 'generos.id', '=', 'delegados.genero_id')
                                        ->join('estudios' , 'estudios.id', '=', 'delegados.estudio_id')
                                        ->join('situacions' , 'situacions.id', '=', 'delegados.situacion_id')
                                        ->join('regions' , 'regions.id', '=', 'delegacions.region_id')
                                        ->select('regions.id as region_id','regions.nombre as nomRegion', 'regions.sede', 'delegacions.id as delegacion_id','delegacions.slug as delegacion','delegados.id', 'delegados.nombre', 'delegados.ap_paterno', 'delegados.ap_materno','generos.id as genero_id', 'generos.genero', 'delegados.rfc', 
                                        'estudios.id as estudios_id','estudios.maximo_estudio', 'situacions.id as estado_id','situacions.estado_civil', 'delegados.email', 'delegados.telefono', 'delegados.facebook', 'delegados.twitter', 'delegados.imagen')        
                                        ->orderBy('delegados.id','desc')
                                        ->paginate(30);
        } else {
            $delegados = Delegado::join('delegacions' , 'delegacions.id', '=', 'delegados.delegacion_id')
                                        ->join('generos' , 'generos.id', '=', 'delegados.genero_id')
                                        ->join('estudios' , 'estudios.id', '=', 'delegados.estudio_id')
                                        ->join('situacions' , 'situacions.id', '=', 'delegados.situacion_id')
                                        ->join('regions' , 'regions.id', '=', 'delegacions.region_id')
                                        ->select('regions.id as region_id','regions.nombre as nomRegion', 'regions.sede', 'delegacions.id as delegacion_id','delegacions.slug as delegacion','delegados.id', 'delegados.nombre', 'delegados.ap_paterno', 'delegados.ap_materno','generos.id as genero_id', 'generos.genero', 'delegados.rfc', 
                                        'estudios.id as estudios_id','estudios.maximo_estudio', 'situacions.id as estado_id','situacions.estado_civil', 'delegados.email', 'delegados.telefono', 'delegados.facebook', 'delegados.twitter')        
                                        ->where('delegados.'.$criterio, 'LIKE', '%'.$buscar.'%') 
                                        ->orderBy('delegados.id','desc')
                                        ->paginate(30);
        }


        return [
            'pagination' => [
                'total' => $delegados->total(),
                'current_page' => $delegados->currentPage(),
                'per_page' => $delegados->perPage(),	
                'last_page' => $delegados->lastPage(),
                'from' => $delegados->firstItem(),	
                'to' => $delegados->lastItem()
            ], 'delegados' => $delegados
        ]; 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
            $regiones = Region::all();
            $delegaciones = Delegacion::all();     
            $generos = Genero::all();   
            $situaciones = Situacion::all();
            $estudios = Estudio::all();
            return view ('admin.delegados.create')->with(compact('regiones','delegaciones','generos','situaciones','estudios'));
        */
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
            $delegado = new Delegado();

            $delegado->delegacion_id = $request->get('delegaciones');
            $delegado->nombre = strtoupper($request->get('nombre'));
            $delegado->ap_paterno = strtoupper($request->get('apellido_paterno'));
            $delegado->ap_materno = strtoupper($request->get('apellido_materno'));
            $delegado->genero_id = $request->get('genero');
            $delegado->rfc = strtoupper($request->get('rfc'));
            $delegado->estudio_id = $request->get('estudio');
            $delegado->situacion_id = $request->get('situacion');
            $delegado->email = $request->get('correo');
            $delegado->telefono = $request->get('telefono');
            $delegado->facebook = $request->get('facebook');
            $delegado->twitter = $request->get('twitter');
            $delegado->seccion = "SECCIÓN 56";
            $delegado->estado = "VERACRUZ";
            $delegado->slug = $delegado->nombre.'_'.$delegado->ap_paterno.'_'.$delegado->ap_materno;

            $delegacion = Delegacion::where('id',$delegado->delegacion_id)->get();

            if ($request->hasFile('foto')) 
            {
                $delegado->imagen = $request->file('foto')->store('public');
            }        

            $reglas = [
                'delegaciones' => 'required',
                'nombre' => 'required',
                'apellido_paterno' => 'required',
                'genero' => 'required',
                'rfc' => 'required',
                'estudio' => 'required',
                'situacion' => 'required',
                'correo' => 'required|unique:delegados,email',   
                'foto' => 'required|image' 
            ];

            $mensaje =[
                'delegaciones.required' => 'Es necesario seleccionar una Delegacion',
                'nombre.required' => 'Ingresa un nombre para el Delegado',
                'apellido_paterno.required' => 'Es necesario escribas un apellido para '. $delegado->nombre,
                'genero.required' => 'Se requiere colocar GENERO',
                'rfc.required' => 'Es necesario colocar tu RFC',
                'estudio.required' => '¿Cúal es tu máximo grado de Estudio?',
                'situacion.required' => '¿Cúal es tu estado civíl?',
                'correo.required' => 'Tu correo electrónico es necesario',
                'correo.unique' => 'El correo que proporcionaste ya ha sido registrado',
                'foto.required' => 'Se requiere una fotografía para '. $delegado->nombre
            ];

            $this->validate($request, $reglas, $mensaje);       
            
            $delegado->save();
            return redirect('admin/delegados')->with('success','Archivo creado');
        */






        // if (!$request->ajax()) return redirect('/admin');

        $delegado = new Delegado();
        
        $delegado->nombre = strtoupper($request->nombre);
        $delegado->ap_paterno = strtoupper($request->ap_paterno);
        $delegado->ap_materno = strtoupper($request->ap_materno);
        $delegado->rfc = strtoupper($request->rfc);
        $delegado->email = $request->email;
        $delegado->telefono = $request->telefono;
        $delegado->facebook = $request->facebook;
        $delegado->twitter = $request->twitter;


        if ($request->photo /*!= $foto_actual*/) {
            $name = time().'.'.explode('/', explode(':', substr($request->photo,0,strpos($request->photo,';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/img_delegados/').$name);
            // $request->merge(['photo' => $name]);
            $delegado->imagen = $name;
        }
        


        $delegado->delegacion_id = $request->delegacion;
        $delegado->genero_id = $request->genero;
        $delegado->estudio_id = $request->max_estudios;
        $delegado->situacion_id = $request->estado_civil;  

        $delegado->slug = $request->nombre.'_'.$request->ap_paterno.'_'.$request->ap_materno;    

        
        $delegado->user_id = 1;

        $delegado->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        /*
            $delegado = Delegado::where('slug','=', $slug)->firstOrFail();
            $regiones = Region::all();
            $delegaciones = Delegacion::all();
            $generos = Genero::all();
            $situaciones = Situacion::all();
            $estudios = Estudio::all();
            $nomenclaturas = Nomenclatura::all();
            $niveles = Nivel::all();

            return view('admin.delegados.show',compact('delegado','regiones','delegaciones','generos','situaciones','estudios','nomenclaturas','niveles'));
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        /*
            $delegado = Delegado::where('slug','=', $slug)->firstOrFail();
            $regiones = Region::all();
            $delegaciones = Delegacion::all();
            $generos = Genero::all();
            $situaciones = Situacion::all();
            $estudios = Estudio::all();
            $nomenclaturas = Nomenclatura::all();
            $niveles = Nivel::all();

            return view('admin.delegados.edit',compact('delegado','regiones','delegaciones','generos','situaciones','estudios','nomenclaturas','niveles'));
        */

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        /*
            $delegado = Delegado::where('slug','=', $slug)->firstOrFail();        
            $delegado->delegacion_id = $request->get('delegaciones');
            $delegado->nombre = strtoupper($request->get('nombre'));
            $delegado->ap_paterno = strtoupper($request->get('apellido_paterno'));
            $delegado->ap_materno = strtoupper($request->get('apellido_materno'));
            $delegado->genero_id = $request->get('genero');
            $delegado->rfc = strtoupper($request->get('rfc'));
            $delegado->estudio_id = $request->get('estudio');
            $delegado->situacion_id = $request->get('situacion');
            $delegado->email = $request->get('correo');
            $delegado->telefono = $request->get('telefono');
            $delegado->facebook = $request->get('facebook');
            $delegado->twitter = $request->get('twitter');
            $delegado->seccion = "SECCIÓN 56";
            $delegado->estado = "VERACRUZ";
            $delegado->slug = $delegado->nombre.'_'.$delegado->ap_paterno.'_'.$delegado->ap_materno;

            $delegacion = Delegacion::where('id',$delegado->delegacion_id)->get();


            if ($request->hasFile('foto')) 
            {
                $delegado->imagen = $request->file('foto')->store('public');
            }        

            
            $reglas = [
                'delegaciones' => 'required',
                'nombre' => 'required',
                'apellido_paterno' => 'required',
                'genero' => 'required',
                'rfc' => 'required',
                'estudio' => 'required',
                'situacion' => 'required',
                'correo' => 'required|email|unique:delegados,email,'.$delegado->id
            ];

            if ($request->hasFile('foto')) 
            {
                $reglas+=['foto' => 'required|image']; 
            }   


            $mensaje =[
                'delegaciones.required' => 'Es necesario seleccionar una Delegacion',
                'nombre.required' => 'Ingresa un nombre para el Delegado',
                'apellido_paterno.required' => 'Es necesario escribas un apellido para '. $delegado->nombre,
                'genero.required' => 'Se requiere colocar GENERO',
                'rfc.required' => 'Es necesario colocar tu RFC',
                'estudio.required' => '¿Cúal es tu máximo grado de Estudio?',
                'situacion.required' => '¿Cúal es tu estado civíl?',
                'correo.required' => 'Tu correo electrónico es necesario',
                'correo.unique' => 'El correo que proporcionaste ya ha sido registrado',
                'foto.required' => 'Se requiere una fotografía para '. $delegado->nombre
            ];

            $this->validate($request, $reglas, $mensaje);     
            

            $delegado->save();
            
            return redirect('/admin/delegados')->with('success','Actualización realizada satisfactoriamente');
        */

        $delegado = Delegado::findOrFail($request->id);

        $delegado->nombre = strtoupper($request->nombre);
        $delegado->ap_paterno = strtoupper($request->ap_paterno);
        $delegado->ap_materno = strtoupper($request->ap_materno);
        $delegado->rfc = strtoupper($request->rfc);
        $delegado->email = $request->email;
        $delegado->telefono = $request->telefono;
        $delegado->facebook = $request->facebook;
        $delegado->twitter = $request->twitter;


        $delegado->delegacion_id = $request->delegacion;
        $delegado->genero_id = $request->genero;
        $delegado->estudio_id = $request->max_estudios;
        $delegado->situacion_id = $request->estado_civil;  
        

        $foto_actual = $delegado->imagen;
        

        if ($request->photo != $foto_actual) {
            $name = time().'.'.explode('/', explode(':', substr($request->photo,0,strpos($request->photo,';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/img_delegados/').$name);
            // $request->merge(['photo' => $name]);
            $delegado->imagen = $name;
        }




        $delegado->slug = $request->nombre.'_'.$request->ap_paterno.'_'.$request->ap_materno;    
        $delegado->user_id = 1;

        $delegado->save();        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
            $delegado = Delegado::where('slug','=', $slug)->firstOrFail();        
            $delegado->delete();
            return redirect('/admin/delegados')->with('success','La información ha sido borrada');
        */
        
        Delegado::find($id)->delete();
    }

    public function delegaciones($id)
    {
        return Delegacion::where('region_id', $id)->get();
    }

    public function export()
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

        // return Excel::store(new DelegadosExport, 'delegados.csv');
    }

    public function arrayGeneros(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');
        $generos = Genero::all();
        return $generos;
    }
    public function arrayEstudios(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');
        $estudios = Estudio::all();
        return $estudios;
    }
    public function arrayEcivil(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');
        $situaciones = Situacion::all();
        return $situaciones;
    }
    public function arrayDelegaciones(Request $request, $id)
    {
        // if (!$request->ajax()) return redirect('/admin');
        // $delegaciones = Delegacion::all();
        $delegaciones = Delegacion::where('region_id', $id)->get();
        return $delegaciones;
    }
    public function arrayRegiones(Request $request)
    {
        // return Delegacion::where('region_id', $id)->get();
        $regiones = Region::all();
        return $regiones;
    }
}
