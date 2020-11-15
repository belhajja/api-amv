<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        

        //Société
        Permission::create(['name' => 'create Société']);
        Permission::create(['name' => 'edit Société']);
        Permission::create(['name' => 'delete Société']);
        Permission::create(['name' => 'view Société']);

        //Adhérent
        Permission::create(['name' => 'create Adhérent']);
        Permission::create(['name' => 'edit Adhérent']);
        Permission::create(['name' => 'delete Adhérent']);
        Permission::create(['name' => 'view Adhérent']);

        //Bénéficiaire
        Permission::create(['name' => 'create Bénéficiaire']);
        Permission::create(['name' => 'edit Bénéficiaire']);
        Permission::create(['name' => 'delete Bénéficiaire']);
        Permission::create(['name' => 'view Bénéficiaire']);

        //All Demande Société
        Permission::create(['name' => 'create Demande']);
        Permission::create(['name' => 'edit Demande']);
        Permission::create(['name' => 'delete Demande']);
        Permission::create(['name' => 'view Demande']);

        //Demande Société
        Permission::create(['name' => 'create Demande Société']);
        Permission::create(['name' => 'edit Demande Société']);
        Permission::create(['name' => 'delete Demande Société']);
        Permission::create(['name' => 'view Demande Société']);

        //Demande Adhérent
        Permission::create(['name' => 'create Demande Adhérent']);
        Permission::create(['name' => 'edit Demande Adhérent']);
        Permission::create(['name' => 'delete Demande Adhérent']);
        Permission::create(['name' => 'view Demande Adhérent']);

        //Demande Dossier
        Permission::create(['name' => 'create Demande Dossier']);
        Permission::create(['name' => 'edit Demande Dossier']);
        Permission::create(['name' => 'delete Demande Dossier']);
        Permission::create(['name' => 'view Demande Dossier']);

        //Demande Dossier
        Permission::create(['name' => 'create Dossier']);
        Permission::create(['name' => 'edit Dossier']);
        Permission::create(['name' => 'delete Dossier']);
        Permission::create(['name' => 'view Dossier']);


        //Tracking Demande
        Permission::create(['name' => 'create Tracking Demande']);
        Permission::create(['name' => 'edit Tracking Demande']);
        Permission::create(['name' => 'delete Tracking Demande']);
        Permission::create(['name' => 'view Tracking Demande']);    
        
        //Contact
        Permission::create(['name' => 'create Contact']);
        Permission::create(['name' => 'edit Contact']);
        Permission::create(['name' => 'delete Contact']);
        Permission::create(['name' => 'view Contact']); 

        //Roles
        Permission::create(['name' => 'manage Roles']);

        // Access Permissions
        Permission::create(['name' => 'Access All']);
        Permission::create(['name' => 'Access Manager']);
        Permission::create(['name' => 'Access User']);

        // Administrateur user creation 
        $user = new User();
        $user->name = "Administrateur";
        $user->email = "administrateur@gmail.com";
        $user->password = bcrypt('password');
        $user->save();

        $user->givePermissionTo("Access All");

        // Manager user creation 
        $user = new User();
        $user->name = "Manager";
        $user->email = "manager@gmail.com";
        $user->password = bcrypt('password');
        $user->save();

        $user->givePermissionTo("Access Manager");
        $user->givePermissionTo("view Société");
        $user->givePermissionTo("view Adhérent");
        $user->givePermissionTo("view Bénéficiaire");
        $user->givePermissionTo("view Demande Société");
        $user->givePermissionTo("view Demande Adhérent");
        $user->givePermissionTo("view Demande Dossier");
        $user->givePermissionTo("view Dossier");
        $user->givePermissionTo("view Tracking Demande");
        $user->givePermissionTo("view Contact");


        // user creation 
        $user = new User();
        $user->name = "User";
        $user->email = "user@gmail.com";
        $user->password = bcrypt('password');
        $user->save();

        $user->givePermissionTo("Access User");
        $user->givePermissionTo("view Adhérent");
        $user->givePermissionTo("view Bénéficiaire");
        $user->givePermissionTo("view Demande Adhérent");
        $user->givePermissionTo("view Demande Dossier");
        $user->givePermissionTo("view Dossier");
        $user->givePermissionTo("view Tracking Demande");
    }
}
