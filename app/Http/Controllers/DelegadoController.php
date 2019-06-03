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

class DelegadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegados = Delegado::all();
        $regiones = Region::all();
        $delegaciones = Delegacion::all();     
        $generos = Genero::all();   
        $situaciones = Situacion::all();
        $estudios = Estudio::all();
        $nomenclaturas = Nomenclatura::all();
        $niveles = Nivel::all();

        return view ('admin.delegados.index',compact('delegados','delegaciones','regiones','nomenclaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = Region::all();
        $delegaciones = Delegacion::all();     
        $generos = Genero::all();   
        $situaciones = Situacion::all();
        $estudios = Estudio::all();
        return view ('admin.delegados.create')->with(compact('regiones','delegaciones','generos','situaciones','estudios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $delegado = Delegado::where('slug','=', $slug)->firstOrFail();
        $regiones = Region::all();
        $delegaciones = Delegacion::all();
        $generos = Genero::all();
        $situaciones = Situacion::all();
        $estudios = Estudio::all();
        $nomenclaturas = Nomenclatura::all();
        $niveles = Nivel::all();

        return view('admin.delegados.show',compact('delegado','regiones','delegaciones','generos','situaciones','estudios','nomenclaturas','niveles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $delegado = Delegado::where('slug','=', $slug)->firstOrFail();
        $regiones = Region::all();
        $delegaciones = Delegacion::all();
        $generos = Genero::all();
        $situaciones = Situacion::all();
        $estudios = Estudio::all();
        $nomenclaturas = Nomenclatura::all();
        $niveles = Nivel::all();

        return view('admin.delegados.edit',compact('delegado','regiones','delegaciones','generos','situaciones','estudios','nomenclaturas','niveles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        
        
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $delegado = Delegado::where('slug','=', $slug)->firstOrFail();        
        $delegado->delete();
        return redirect('/admin/delegados')->with('success','La información ha sido borrada');
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
}
