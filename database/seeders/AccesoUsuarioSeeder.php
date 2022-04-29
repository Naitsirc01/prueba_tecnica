<?php

namespace Database\Seeders;

use App\Models\Acceso_usuario;
use Illuminate\Database\Seeder;

class AccesoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_id=[1,2];
        $accesos=[1,2,3];
        foreach($users_id as $u_id){
            foreach($accesos as $id){
                $au=new Acceso_usuario();
                $au->user_id=$u_id;
                $au->acceso_id=$id;
                $au->save();
            }
        }
    }
}
