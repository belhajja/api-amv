<?php

namespace App\Http\Controllers;

use App\Adherent;
use App\Societe;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createrole(Request $request){
        
        $role = Role::create(['name' => $request->name]);
        
        return response()->json([
            'message' => 'succès ! Nouveau Rôle crée',
            'role' => $role
        ]);
    }
    
    public function assignrole(Request $request) {

        $user = User::find($request->user);

        $role = Role::find($request->role);

        $user->assignRole($role);

        return response()->json([
            'message' => 'succès ! Rôle assigné',
        ]);
    }

    public function givePermissiontoUser(Request $request){

        $user = User::find($request->user);

        $user->givePermissionTo($request->permission);

        return response()->json([
            'message' => 'succès ! Permission assignée',
        ]);
    }

    public function givePermissiontoRole(Request $request){
        
        $role = Role::find($request->role);

        $role->givePermissionTo($request->permission);

        return response()->json([
            'message' => 'succès ! Permission assignée',
        ]);
    }

    public function syncPermissions(Request $request){

        $role = Role::find($request->role);

        $permissions = $request->permissions;

        $role->syncPermissions($permissions);

        return response()->json([
            'message' => 'succès ! Permissions synchronisées',
        ]);

    }

    public function removePermission(Request $request){

        $role = Role::find($request->role);

        $role->revokePermissionTo($request->permission);

        return response()->json([
            'message' => 'succès ! Permission Revoked',
        ]);
    }

    public function getPermission(Request $request){
        
        $user = User::find($request->user);

        if ($user) {
            switch ($request->type) {
                case 'Names':
                    $permissions = $user->getPermissionNames();
                    break;
                case 'Direct':
                    $permissions = $user->getDirectPermissions();
                    break;
                case 'Role':
                    $permissions = $user->getPermissionsViaRoles();
                    break;
                case 'All':
                    $permissions = $user->getAllPermissions();
                    break;
                default:
                    return NULL;
            }
            return $permissions;
        }
        
        return response()->json([],204); 
    }

    public function getRoles(User $user){

        $roles = $user->getRoleNames();

        return $roles;

    }

    public function setAttachedAdherent(Request $request){

        $user = User::find($request->user);
        $adherent = Adherent::find($request->adherent);

        //purge previous settings if any

        if ($user->societes()){
            $user->societes()->detach();
        }
        
        $user->adherents()->attach($adherent);

        return response()->json(['Success'],200);
    }

    public function setAttachedSociete(Request $request){

        $user = User::find($request->user);
        $societe = Societe::find($request->societe);

        //purge previous settings if any

        if ($user->adherents()){
            $user->adherents()->detach();
        }

        $user->societes()->attach($societe);

        return response()->json(['Success'],200);
    }

    public function getAttachedModels(Request $request){

        switch ($request->type){
            case 'sociétés':
                return $request->user->societes();
            case 'adhérents':
                return $request->user->adherents();
        }
    }

}
