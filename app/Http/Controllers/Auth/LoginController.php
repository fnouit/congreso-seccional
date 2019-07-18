<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view ('auth.login');
    }

    public function loginRegistro(Request $request){
        
        // if (!$request->ajax()) return redirect('/');

        $this->validateLogin($request);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password/* ,'rol_id'=>1 */]))
        {
            return redirect()->route('admin');
        }
        return back()->withErrors(['email'=>trans('auth.failed')])
                    ->withInput(request(['email']));
    }

    public function logout(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        Auth::logout();
        $request->session()->invalidate();
        // return redirect()->route('admin');
        return redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request,[
            "email"=> 'required|string',
            "password"=> 'required|string'
        ]);
    }
}
