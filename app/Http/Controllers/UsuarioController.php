<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delegado;
use App\Region;
use App\Delegacion;
use App\Genero;
use App\Situacion;
use App\Estudio;
use App\Nomenclatura;
use App\Nivel;

class UsuarioController extends Controller
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

        return view ('usuario.index',compact('delegados','delegaciones','regiones','nomenclaturas'));
    }

    public function create()
    {
        $regiones = Region::all();
        $delegaciones = Delegacion::all();     
        $generos = Genero::all();   
        $situaciones = Situacion::all();
        $estudios = Estudio::all();
        return view ('usuario.create')->with(compact('regiones','delegaciones','generos','situaciones','estudios'));
    }

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
        // return url('usuario/index');
        // return view('home');
        return redirect()->action('HomeController@index');
    }

    public function delegaciones($id)
    {
        return Delegacion::where('region_id', $id)->get();
    }
}
