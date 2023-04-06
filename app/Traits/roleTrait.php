<?php
namespace App\Traits;

trait roleTrait{
    public function hasRole(){

        $role = auth()->user()->role->name;

        if ($role != 'superadmin'
            && \Route::is('superadmin_users.index')
            || \Route::is('superadmin_users.store')
            || \Route::is('superadmin_users.create')
            || \Route::is('superadmin_users.show')
            || \Route::is('superadmin_users.update')
            || \Route::is('superadmin_users.destroy')
            || \Route::is('superadmin_users.edit')){
            return abort(401);
        }


        if ($role != 'superadmin'
            && \Route::list('superadmin_roles')
//            || \Route::is('superadmin_roles.store')
//            || \Route::is('superadmin_roles.create')
//            || \Route::is('superadmin_roles.show')
//            || \Route::is('superadmin_roles.update')
//            || \Route::is('superadmin_roles.destroy')
//            || \Route::is('superadmin_roles.edit')

        ){
            return abort(401);
        }

        if ($role != 'superadmin'
            && \Route::is('superadmin_wifi_sites.index')
            || \Route::is('superadmin_wifi_sites.store')
            || \Route::is('superadmin_wifi_sites.create')
            || \Route::is('superadmin_wifi_sites.show')
            || \Route::is('superadmin_wifi_sites.update')
            || \Route::is('superadmin_wifi_sites.destroy')
            || \Route::is('superadmin_wifi_sites.edit')){
            return abort(401);
        }

        if ($role != 'superadmin'
            && \Route::is('superadmin_access_providers.index')
            || \Route::is('superadmin_access_providers.store')
            || \Route::is('superadmin_access_providers.create')
            || \Route::is('superadmin_access_providers.show')
            || \Route::is('superadmin_access_providers.update')
            || \Route::is('superadmin_access_providers.destroy')
            || \Route::is('superadmin_access_providers.edit')){
            return abort(401);
        }



    }
}
