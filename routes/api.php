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

Route::group([
    'prefix' => 'role'
], function () {
    Route::post('createrole', 'RoleController@createrole');
    Route::post('assignrole', 'RoleController@assignrole');
    Route::post('get', 'RoleController@getRoles');
});

Route::group([
    'prefix' => 'permission'
], function () {
Route::post('user', 'RoleController@givePermissiontoUser');
Route::post('role', 'RoleController@givePermissiontoRole');
Route::post('sync', 'RoleController@syncPermissions');
Route::post('revoke', 'RoleController@removePermission');
Route::post('get', 'RoleController@getPermission');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'middleware' => 'jwt'
], function() {
    Route::resource('societe', 'SocieteController');
    Route::resource('adherent', 'AdherentController');
    Route::resource('dossier', 'DossierController');
    Route::resource('demande', 'DemandeController');
    Route::resource('beneficiaire', 'BeneficiaireController');
    Route::resource('contact', 'ContactController');
    Route::resource('trackingdemande', 'TrackingDemandeController');
});
