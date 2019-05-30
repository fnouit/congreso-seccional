<?php

namespace App\Http\Controllers;

use App\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = Nivel::all();
        return view ('admin.niveles.index',compact('niveles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.niveles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nivel = new Nivel();

        $mensaje =[
            'nivel_educativo.required' => 'Es necesario ingresar un nombre para el Nivel',
            'slug.required' => 'El nombre de el slug es necesario',
        ];

        $reglas = [
            'nivel_educativo' => 'required',
            'slug' => 'required',
        ];

        $this->validate($request, $reglas, $mensaje);

        
        $nivel->nivel_educativo = $request->nivel_educativo;
        $nivel->slug = $request->slug;

        $nivel->save();
        return redirect('/niveles')->with('success','Archivo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $nivel = Nivel::where('slug','=', $slug)->firstOrFail();
        return view ('admin.niveles.show',compact('nivel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $nivel = Nivel::whereSlug($slug)->firstOrFail();
        return view ('admin.niveles.edit')->with(compact('nivel'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $mensaje =[
            'nivel_educativo.required' => 'Es necesario ingresar un nombre para el Nivel',
            'slug.required' => 'El nombre de el slug es necesario',
        ];

        $reglas = [
            'nivel_educativo' => 'required',
            'slug' => 'required',
        ];

        $this->validate($request, $reglas, $mensaje);

        $nivel = Nivel::where('slug','=', $slug)->firstOrFail();
        
        $nivel->nivel_educativo = $request->nivel_educativo;
        $nivel->slug = $request->slug;
        $nivel->save();

        return redirect()->route('mostrar.nivel',[$nivel->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $nivel = Nivel::where('slug','=', $slug)->firstOrFail();        
        $nivel->delete();
        return redirect('/niveles')->with('borrado','La información ha sido borrada');
    }
}
