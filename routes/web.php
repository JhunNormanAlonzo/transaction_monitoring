<?php

use App\Http\Controllers\AccessCodeController;
use App\Http\Controllers\AccessProviderController;
use App\Http\Controllers\AdminAccessProviderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminWalletTransactionController;
use App\Http\Controllers\LoadTransactionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProviderLoadTransactionController;
use App\Http\Controllers\ProviderRequestController;
use App\Http\Controllers\ProviderWalletTransactionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuperAdminAccessCodeController;
use App\Http\Controllers\SuperAdminAccessProviderController;
use App\Http\Controllers\SuperAdminAreaController;
use App\Http\Controllers\SuperAdminLoadTypeController;
use App\Http\Controllers\SuperAdminProviderTypeController;
use App\Http\Controllers\SuperAdminRegionController;
use App\Http\Controllers\SuperAdminRoleController;
use App\Http\Controllers\SuperAdminUploadController;
use App\Http\Controllers\SuperAdminUserController;
use App\Http\Controllers\SuperAdminWalletTransactionTypeController;
use App\Http\Controllers\SuperAdminWifiSiteController;
use App\Http\Controllers\WalletTransactionController;
use App\Http\Controllers\WifiSiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataTable\TablesController;


Auth::routes();

Route::get('/carousel', function (){
    return view('carousel');
});

Route::get('/responsive', function (){
    return view('test.responsive.index');
});

Route::group(['middleware' => ['guest']], function(){
    Route::get('/', function () {
        return view('index');
    });
});

Route::group(['middleware' => ['auth']], function (){

    Route::group(['middleware' => ['auth', 'isForbidden']], function(){
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::resource('access_providers', AccessProviderController::class);
        Route::get('/access_providers', [AccessProviderController::class, 'index'])->name('access_providers.index');
        Route::resource('wifi_sites', WifiSiteController::class);
        Route::resource('wallet_transactions', WalletTransactionController::class);
        Route::resource('provider_requests', ProviderRequestController::class);
        Route::resource('access_codes', AccessCodeController::class);
        Route::resource('load_transactions', LoadTransactionController::class);
    });


    Route::get('/', function (){
        $role = auth()->user()->role->name;

        if ($role == 'superadmin'){
            return redirect()->route('superadmin_users.index');
        }else if ($role == 'admin'){
            return redirect()->route('admin_wallet_transactions.index');
        }else if ($role == 'access provider'){
            return redirect()->route('provider_ledger');
        }
    });




    Route::group(['middleware' => ['auth', 'isAdmin']], function(){
        Route::get('/send', [AdminController::class, 'send']);
        Route::get('admin_ledger', [AdminController::class, 'ledger'])->name('admin_ledger');
        Route::get('admin_access_providers/{admin_access_provider}/all_providers', [AdminAccessProviderController::class, 'wallet_transaction'])->name('admin_access_providers.all_providers');
//        Route::resource('provider_wallet_transactions', ProviderWalletTransactionController::class);
//        Route::resource('provider_load_transactions', ProviderLoadTransactionController::class);
        Route::resource('admin_wallet_transactions', AdminWalletTransactionController::class);
//        Route::resource('admin_users', AdminUserController::class);
        Route::resource('admin_access_providers', AdminAccessProviderController::class);
        Route::POST('admin_wallet_transactions/approve_request', [AdminController::class, 'approve_request'])->name('admin_wallet_transactions.approve_request');
        Route::POST('admin_wallet_transactions/decline_request', [AdminController::class, 'decline_request'])->name('admin_wallet_transactions.decline_request');
    });

    Route::group(['middleware' => ['auth', 'isAccessProvider']], function(){
        Route::get('provider_ledger', [ProviderController::class, 'ledger'])->name('provider_ledger');
        Route::resource('providers', ProviderController::class);
        Route::resource('provider_wallet_transactions', ProviderWalletTransactionController::class);
        Route::resource('provider_load_transactions', ProviderLoadTransactionController::class);
        Route::get('fetch', [AdminController::class, 'fetchNotif'])->name('fetch');
    });



    Route::group(['middleware' => ['auth', 'isSuperAdmin']], function(){
        Route::get('superadmin_access_codes/send_load', [SuperAdminAccessCodeController::class, 'onlyLoaded'])->name('superadmin_access_codes.send_load');
        Route::get('superadmin_access_codes/import_logs', [SuperAdminAccessCodeController::class, 'import_logs'])->name('superadmin_access_codes.import_logs');
        Route::resource('superadmin_access_codes', SuperAdminAccessCodeController::class);
        Route::resource('superadmin_uploads', SuperAdminUploadController::class);
        Route::resource('superadmin_roles', SuperAdminRoleController::class);
        Route::resource('superadmin_users', SuperAdminUserController::class);
        Route::resource('superadmin_wifi_sites', SuperAdminWifiSiteController::class);
        Route::resource('superadmin_access_providers', SuperAdminAccessProviderController::class);
        Route::resource('superadmin_areas', SuperAdminAreaController::class);
        Route::resource('superadmin_regions', SuperAdminRegionController::class);
        Route::resource('superadmin_provider_types', SuperAdminProviderTypeController::class);
        Route::resource('superadmin_load_types', SuperAdminLoadTypeController::class);
        Route::resource('superadmin_transaction_types', SuperAdminWalletTransactionTypeController::class);
    });



});








