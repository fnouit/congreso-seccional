<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regiones = Region::all();
        // return view ('admin.regiones.index',compact('regiones'));
        return $regiones;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $region = Region::where('slug','=', $slug)->firstOrFail();
        $delegaciones = \App\Delegacion::where('region_id',$region->id)->paginate(10);
        $count_deleg =  \App\Delegacion::where('region_id',$region->id)->count();
        $nomenclaturas = \App\Nomenclatura::get();
        // dd($delegaciones);
        return view ('admin.regiones.show',compact('region','nomenclaturas','delegaciones','count_deleg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $region = Region::whereSlug($slug)->firstOrFail();
        return view ('admin.regiones.edit')->with(compact('region'));       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $mensaje =[
            'nombre.required' => 'Es necesario ingresar un nombre para la Región',
            'sede.required' => 'El nombre de la sede es necesario',
            'coordinador.required' => 'Nombre de coordinador es requerido',
            'email.required' => 'Es necesario que ingreses un correo electrónico',
            'email.email' => 'Debes ingresar un correo valido',
            'email.unique' => 'El email ya ha sido registrado'
        ];

        $reglas = [
            'nombre' => 'required',
            'sede' => 'required',
            'coordinador' => 'required',
            'email' => 'email|required',
            'telefono' => 'required',
            'photo_extension' => 'image'
        ];

        $this->validate($request, $reglas, $mensaje);

        $region = Region::where('slug','=', $slug)->firstOrFail();
        
        $region->nombre = $request->nombre;
        $region->sede = $request->sede;
        $region->coordinador = $request->coordinador;
        $region->email = $request->email;
        $region->telefono = $request->telefono;
        
        if($request->hasFile('photo'))
        {
            $region->photo_extension = $request->file('photo')->store('public');
        }

        

        // return $request;
        $region->save();

        return redirect()->route('mostrar.region',[$region->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }
}
