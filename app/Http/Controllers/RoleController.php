<?php

namespace App\Http\Controllers;

use App\Adherent;
use App\Societe;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createrole(Request $request)
    {

        try {
            $role = Role::findByName($request->name);
        } catch (Exception $e) {
            $role = Role::create(['name' => $request->name]);
        }

        return $role;
    }

    public function deletRole(Request $request)
    {

        try {
            $role = Role::findByName($request->name);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }

        try {
            $role->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }

            return response()->json([
                'message' => 'succès ! Rôle Supprimé',
            ]);
    }

    public function assignrole(Request $request)
    {

        $user = User::find($request->user);

        $role = Role::find($request->role);

        $user->assignRole($role);

        return response()->json([
            'message' => 'succès ! Rôle assigné',
        ]);
    }

    public function givePermissiontoUser(Request $request)
    {

        $user = User::find($request->user);

        $user->givePermissionTo($request->permission);

        return response()->json([
            'message' => 'succès ! Permission assignée',
        ]);
    }

    public function givePermissiontoRole(Request $request)
    {

        $role = Role::find($request->role);

        $role->givePermissionTo($request->permission);

        return response()->json([
            'message' => 'succès ! Permission assignée',
        ]);
    }

    public function syncPermissions(Request $request)
    {

        $role = Role::find($request->role);

        $permissions = $request->permissions;

        $role->syncPermissions($permissions);

        return response()->json([
            'message' => 'succès ! Permissions synchronisées',
        ]);
    }

    public function removePermission(Request $request)
    {

        $role = Role::find($request->role);

        $role->revokePermissionTo($request->permission);

        return response()->json([
            'message' => 'succès ! Permission Revoked',
        ]);
    }

    public function getPermission(User $user)
    {

        if ($user) {
            return $user->getAllPermissions()->makeHidden('pivot');
        }

        return response()->json([], 204);
    }

    public function getRoles()
    {

        $roles = Role::with('permissions')->get();

        return $roles;
    }

    public function setAttachedAdherent(Request $request)
    {

        $user = User::find($request->user);
        $adherent = Adherent::find($request->adherent);

        //purge previous settings if any

        if ($user->societes()) {
            $user->societes()->detach();
        }

        $user->adherents()->attach($adherent);

        return response()->json(['Success'], 200);
    }

    public function DetacheAdherent(Request $request)
    {

        $user = User::find($request->user);
        $adherent = Adherent::find($request->adherent);

        $user->adherents()->detach($adherent);

        return response()->json(['Success'], 200);
    }

    public function setAttachedSociete(Request $request)
    {

        $user = User::find($request->user);
        $societe = Societe::find($request->societe);

        //purge previous settings if any

        if ($user->adherents()) {
            $user->adherents()->detach();
        }

        $user->societes()->attach($societe);

        return response()->json(['Success'], 200);
    }

    public function DetacheSociete(Request $request)
    {

        $user = User::find($request->user);
        $societe = Societe::find($request->societe);

        $user->societes()->detach($societe);

        return response()->json(['Success'], 200);
    }

    public function getAllUsers()
    {
        return User::with('societes')->with('adherents')->with('permissions')->with('roles')->get();
    }

    public function getUserPermissions(Request $request)
    {
        return auth()->user()->with('permissions')->with('roles')->get();
    }
}
