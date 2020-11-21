<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentification and JWT TOKEN
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('{user}', 'RoleController@getPermission');
});


Route::group([
    'middleware' => 'jwt'
], function () {

    // Roles Management
    Route::group([
        'middleware' => 'permission:manage Roles'
    ], function () {

        Route::group([
            'prefix' => 'role'
        ], function () {
            Route::post('createrole', 'RoleController@createrole');
            Route::post('assignrole', 'RoleController@assignrole');
            Route::post('deleterole', 'RoleController@deletRole');
            Route::get('getroles', 'RoleController@getRoles');
        });

        Route::group([
            'prefix' => 'users'
        ], function () {
            Route::get('getUsers', 'RoleController@getAllUsers');
            Route::post('getUserPermissions', 'RoleController@getUserPermissions');
        });

        Route::group([
            'prefix' => 'permission',
        ], function () {
            Route::post('user', 'RoleController@givePermissiontoUser');
            Route::post('role', 'RoleController@givePermissiontoRole');
            Route::post('sync', 'RoleController@syncPermissions');
            Route::post('revoke', 'RoleController@removePermission');
            Route::post('attachsociete', 'RoleController@setAttachedSociete');
            Route::post('attachadherent', 'RoleController@setAttachedAdherent');
            Route::post('detachesociete', 'RoleController@DetacheSociete');
            Route::post('detacheadherent', 'RoleController@DetacheAdherent');
        });
    });

    Route::resource('societe', 'SocieteController');
    Route::resource('adherent', 'AdherentController');
    Route::resource('dossier', 'DossierController');
    Route::resource('demande', 'DemandeController');
    Route::resource('beneficiaire', 'BeneficiaireController');
    Route::resource('contact', 'ContactController');
    Route::resource('trackingdemande', 'TrackingDemandeController');

    Route::post('demande/societe', 'DemandeController@getDemandeBySociete');

});



