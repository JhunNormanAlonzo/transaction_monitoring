<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){

        $this->validate($request, [
           'email' => 'required|email',
            'password' => 'required'
        ]);

        dd("wow");

        $email = $request->email;
        $password = $request->password;
    }
}
