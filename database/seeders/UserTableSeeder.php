<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::find(1);
        $role_user = Role::find(2);

        $user= new User();
        $user->name="admin";
        $user->email="admin@admin.com";
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);
        

        $user= new User();
        $user->name="user";
        $user->email="user@user.com";
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);
        
        
    }
}
