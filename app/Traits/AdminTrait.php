<?php


namespace App\Traits;


trait AdminTrait
{
    public function isAdmin(){
        if (auth()->user()->role->name != 'admin'){
            return abort(401);
        }
    }
}
