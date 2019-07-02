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
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $regiones = Region::orderBy('id','desc')->paginate(5);            
        }
        else{
            $regiones = Region::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(5);
        }

        return [
            'pagination' => [
                'total' => $regiones->total(),
                'current_page' => $regiones->currentPage(),
                'per_page' => $regiones->perPage(),	
                'last_page' => $regiones->lastPage(),
                'from' => $regiones->firstItem(),	
                'to' => $regiones->lastItem()
            ], 'regiones' => $regiones
        ];

        // return view ('admin.regiones.index',compact('regiones'));
        // return $regiones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');
        $region = new Region();
        
        $region->nombre = strtoupper($request->nombre);
        $region->sede = strtoupper($request->sede);
        $region->coordinador = strtoupper($request->coordinador);
        $region->email = $request->correo;
        $region->telefono = $request->telefono;
        $region->photo_extension = $request->photo;
        $region->slug = $request->slug;

        
        
        $region->save();

        // return 'exito registro guardado';
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
    public function update(Request $request)
    {

        if (!$request->ajax()) return redirect('/admin');
        $region = Region::findOrFail($request->id);

        $region->nombre = strtoupper($request->nombre);
        $region->sede = strtoupper($request->sede);
        $region->coordinador = strtoupper($request->coordinador);
        $region->email = $request->correo;
        $region->telefono = $request->telefono;
        $region->photo_extension = $request->photo;
        $region->slug = $request->slug;        
        
/* 
       if($request->hasFile('photo'))
        {
            $region->photo_extension = $request->file('photo')->store('public');
        }
 */
        $region->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $region = Region::findOrFail($request->id);
        // $region->delete();
        // if (!$request->ajax()) return redirect('/admin');
        Region::find($id)->delete();
    }
  
}
