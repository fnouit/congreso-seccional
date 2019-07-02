<?php

namespace App\Http\Controllers;

use App\Nomenclatura;
use Illuminate\Http\Request;

class NomenclaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $nomenclaturas = Nomenclatura::all();
        // return view ('admin.nomenclaturas.index',compact('nomenclaturas'));

        if (!$request->ajax()) return redirect('/admin');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $nomenclaturas = Nomenclatura::orderBy('id','desc')->paginate(15);            
        }
        else{
            $nomenclaturas = Nomenclatura::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(15);
        }

        return [
            'pagination' => [
                'total' => $nomenclaturas->total(),
                'current_page' => $nomenclaturas->currentPage(),
                'per_page' => $nomenclaturas->perPage(),	
                'last_page' => $nomenclaturas->lastPage(),
                'from' => $nomenclaturas->firstItem(),	
                'to' => $nomenclaturas->lastItem()
            ], 'nomenclaturas' => $nomenclaturas
        ];        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view ('admin.nomenclaturas.create');
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
            $nomenclatura = new Nomenclatura();

            $mensaje =[
                'nomenclatura.required' => 'Es necesario ingresar una Nomenclatura de la delegación',
                'slug.required' => 'El nombre de el slug es necesario',
            ];

            $reglas = [
                'nomenclatura' => 'required',
                'slug' => 'required',
            ];

            $this->validate($request, $reglas, $mensaje);

            
            $nomenclatura->nomenclatura = $request->nomenclatura;
            $nomenclatura->slug = $request->slug;

            $nomenclatura->save();
            return redirect('/nomenclaturas')->with('success','Nomenclatura '.$nomenclatura->nomenclatura.' creada satisfactoriamente');
        */
        if (!$request->ajax()) return redirect('/admin');
        $nomenclatura = new Nomenclatura();
        
        $nomenclatura->nomenclatura = strtoupper($request->nombre);
        $nomenclatura->slug = $request->slug;
        
        $nomenclatura->save();        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nomenclatura  $nomenclatura
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $nomenclatura = Nomenclatura::where('slug','=', $slug)->firstOrFail();
        // return view ('admin.nomenclaturas.show',compact('nomenclatura'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nomenclatura  $nomenclatura
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // $nomenclatura = Nomenclatura::whereSlug($slug)->firstOrFail();
        // return view ('admin.nomenclaturas.edit')->with(compact('nomenclatura'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nomenclatura  $nomenclatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*
            $mensaje =[
                'nomenclatura.required' => 'Es necesario ingresar un nombre para la Nomenclatura',
                'slug.required' => 'El nombre de el slug es necesario',
            ];

            $reglas = [
                'nomenclatura' => 'required',
                'slug' => 'required',
            ];

            $this->validate($request, $reglas, $mensaje);

            $nomenclatura = Nomenclatura::where('slug','=', $slug)->firstOrFail();
            
            $nomenclatura->nomenclatura = $request->nomenclatura;
            $nomenclatura->slug = $request->slug;
            $nomenclatura->save();

            return redirect()->route('mostrar.nomenclatura',[$nomenclatura->slug]);
        */
        if (!$request->ajax()) return redirect('/admin');
        $nomenclatura = Nomenclatura::findOrFail($request->id);

        $nomenclatura->nomenclatura = strtoupper($request->nombre);
        $nomenclatura->slug = $request->slug;        

        $nomenclatura->save();        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nomenclatura  $nomenclatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $nomenclatura = Nomenclatura::where('slug','=', $slug)->firstOrFail();        
        // $nomenclatura->delete();
        // return redirect('/nomenclaturas')->with('success','La información ha sido borrada');
        Nomenclatura::find($id)->delete();
    }
}
