<?php


namespace App\Traits;


trait superAdminTrait
{
    public function isSuperAdmin(){
        $role = auth()->user()->role->name;
        if ($role != 'superadmin'){
            return abort(401);
        }
    }
}
