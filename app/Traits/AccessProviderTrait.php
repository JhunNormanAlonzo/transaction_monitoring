<?php


namespace App\Traits;


trait AccessProviderTrait
{
    public function isAccessProvider(){
        if (auth()->user()->role->name != 'access provider'){
            return abort(401);
        }
    }

}
