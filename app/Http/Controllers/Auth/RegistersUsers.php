<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Tipouser;
use App\Tipodocumento;
use App\User;
use Redirect;
use Mail;
use App\Mail\SendRegisterEmail;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {   
        
        return view('auth.register');
    }

    public function registerEmpresa()
    {   
        
        return view('auth.register_empresa');
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {   
        
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Mail::to($user->email)->send(new SendRegisterEmail($user->nombre.' '.$user->apellido, $user->email, $user->confirmation_token)); 

        return $this->registered($request, $user)
                        ?: Redirect::back()-> with('message', 'Usuario registrado, se ha enviado un email de confirmacion a su correo para completar el proceso de registro');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
