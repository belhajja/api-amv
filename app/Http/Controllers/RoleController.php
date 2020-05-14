<?php

namespace App\Http\Controllers;

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
        }

        return $permissions;
    }

    public function getRoles(Request $request){

        $user = User::find($request->user);
        $roles = $user->getRoleNames();

        return $roles;

    }

}
