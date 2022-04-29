<?php

namespace Database\Seeders;

use App\Models\Acceso;
use Illuminate\Database\Seeder;

class AccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acceso=new Acceso();
        $acceso->nombre_acceso='archivos';
        $acceso->save();
        
        $acceso=new Acceso();
        $acceso->nombre_acceso='subida_archivos';
        $acceso->save();

        $acceso=new Acceso();
        $acceso->nombre_acceso='historial_archivos';
        $acceso->save();
    }
}
