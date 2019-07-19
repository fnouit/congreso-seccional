<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users =  User::all();
        // return view('admin.users.index',compact('users'));

        // if (!$request->ajax()) return redirect('/admin');

        // SELECT users.name, users.email, roles.nombre FROM users INNER JOIN roles on roles.id = users.rol_id

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            // $users = User::orderBy('id','desc')->paginate(15);          
            $users = User::join('roles', 'roles.id', '=', 'users.rol_id')
                            ->select('users.id','users.name', 'users.email', 'users.slug','roles.id as rol_id', 'roles.nombre as rol')
                            ->orderBy('users.id','asc')
                            ->paginate(25);
        }
        else{
            $users = User::join('roles', 'roles.id', '=', 'users.rol_id')
                            ->select('users.id','users.name', 'users.email', 'users.slug','roles.id as rol_id', 'roles.nombre as rol')
                            ->orderBy('users.id','asc')
                            ->where('users.'.$criterio, 'like', '%'.$buscar.'%')
                            ->paginate(25);
        }

        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),	
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),	
                'to' => $users->lastItem()
            ], 'users' => $users
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
        // if (!$request->ajax()) return redirect('/admin');

        
        // $user = new User();
            
        // $user->nomenclatura_id  = $request->get('nomenclatura_id');
        // $user->numero  = $request->get('numero') ;
        // $user->sede  = $request->get('sede') ;
        // $user->nivel_id  = $request->get('nivel_id') ;
        // $user->region_id  = $request->get('region_id') ;        
        // $valueNom = Nomenclatura::find($user->nomenclatura_id);
        // $user->slug=$valueNom->nomenclatura.$user->numero;  
        
        // $user->save();   

        /* $request->validate([
            ]); */
            
        $mensaje =[
            'name.required' => 'Es necesario que el campo nombre no este vacio',
            'email.required' => 'El campo correo es necesario',
            'email.unique' => 'El correo que ingreso ya ha sido registrado',
            'rol.required' => 'Selecciona un rol de usuario',
            'password.required' => 'Se requiere una contraseña',
            'slug.required' => 'Ingresa un slug de dirección de página'
        ];
        
        $reglas = [
            'name' => 'required',
            'rol'=> 'required',
            'email' => 'required|unique:users,email',
            'password'=> 'required',
            'slug' => 'required',
        ];

        $this->validate($request, $reglas, $mensaje);        
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol_id = $request->rol;
        $user->slug = $request->slug;
        $user->password = bcrypt($request->password); // Se encripta la contraseña usando la función bcrypt().

        $user->save(); 
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
 
        $mensaje =[
            'name.required' => 'Es necesario que el campo nombre no este vacio',
            'email.required' => 'El campo correo es necesario',
            'email.unique' => 'El correo que ingreso ya ha sido registrado',
            'rol.required' => 'Selecciona un rol de usuario',
            'slug.required' => 'Ingresa un slug de dirección de página'
        ];
        
        $reglas = [
            'name' => 'required',
            'rol'=> 'required',
            'email' => 'required|unique:users,email,'.$user->id,       
            'slug' => 'required',
        ];

        $this->validate($request, $reglas, $mensaje);        
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol_id = $request->rol;
        $user->slug = $request->slug;

        $user->save();         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
