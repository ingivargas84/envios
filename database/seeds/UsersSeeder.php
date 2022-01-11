<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();

        $superadminRole = Role::create(['name' => 'Super-Administrador']);
        $adminRole = Role::create(['name' => 'Administrador']);
        $asisteoficinaRole = Role::create(['name' => 'Asistente-Oficina']);
        $asistebusRole = Role::create(['name' => 'Asistente-Bus']);

        $user = new user;
        $user->name = 'Super Administrador';
        $user->email= 'superadmin@gmail.com';
        $user->password = bcrypt('superadmin');
        $user->username = 'superadmin';
        $user->estado = 1;
        $user->save();
        $user->assignRole($superadminRole); 

        $user = new user;
        $user->name = 'Administrador';
        $user->email= 'administrador@gmail.com';
        $user->password = bcrypt('admin');
        $user->username = 'admin';
        $user->estado = 1;
        $user->save();
        $user->assignRole($adminRole);

        $user = new user;
        $user->name = 'Asistente Oficina';
        $user->email= 'asisteoficina@gmail.com';
        $user->password = bcrypt('asisteoficina');
        $user->username = 'asisteoficina';
        $user->estado = 1;
        $user->save();
        $user->assignRole($asisteoficinaRole); 

        $user = new user;
        $user->name = 'Asistente Bus';
        $user->email= 'asistebus@gmail.com';
        $user->password = bcrypt('asistebus');
        $user->username = 'asistebus';
        $user->estado = 1;
        $user->save();
        $user->assignRole($asistebusRole);  
        
    }
}
