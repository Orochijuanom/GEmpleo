<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->tipouser_id == 1) {
                return redirect('/administrador');
            }elseif(Auth::user()->tipouser_id == 3){
                return redirect('/empresas'); 
            }elseif(Auth::user()->tipouser_id == 2){
                return redirect('/personas');
            }else{
                return Response::view('errors.missing',array() ,401);
            } 
        }else{
            return redirect()->guest('login');
        }
    }
}
