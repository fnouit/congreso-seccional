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
    public function index(Request $request)
    {
        // $niveles = Nivel::all();
        // return view ('admin.niveles.index',compact('niveles'));

        if (!$request->ajax()) return redirect('/admin');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $niveles = Nivel::orderBy('id','desc')->paginate(15);            
        }
        else{
            $niveles = Nivel::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(15);
        }

        return [
            'pagination' => [
                'total' => $niveles->total(),
                'current_page' => $niveles->currentPage(),
                'per_page' => $niveles->perPage(),	
                'last_page' => $niveles->lastPage(),
                'from' => $niveles->firstItem(),	
                'to' => $niveles->lastItem()
            ], 'niveles' => $niveles
        ];

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
        $nivel = new Nivel();
        
        $nivel->nivel_educativo = strtoupper($request->nombre);
        $nivel->slug = $request->slug;
        
        $nivel->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');
        $nivel = Nivel::findOrFail($request->id);

        $nivel->nivel_educativo = strtoupper($request->nombre);
        $nivel->slug = $request->slug;        

        $nivel->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $nivel = Nivel::where('slug','=', $slug)->firstOrFail();        
        // $nivel->delete();
        // return redirect('/niveles')->with('borrado','La información ha sido borrada');
        Nivel::find($id)->delete();
    }
}
