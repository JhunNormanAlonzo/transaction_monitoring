<?php


namespace App\Traits;


trait ForbiddenPageTrait
{
    public function isForbidden(){
        return abort(403, 'Forbidden page, Developer lang puwede maka open.');
    }
}
