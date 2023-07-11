<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //UserController es el controlador encargado de gestionar la vista de login

    public function login($user, $pass): \Illuminate\Contracts\View\View    {
        //Este método recibe dos parámetros, el usuario y la contraseña
        //y comprueba si son correctos
        //Si son correctos, carga la vista de gestión
        //Si no son correctos, carga la vista de login
        if ($user == 'admin' && $pass == 'admin') {
            return view('gestion');
        } else {
            return view('login');
        }
    }
    
}
