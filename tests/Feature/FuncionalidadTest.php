<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Archivo;
use Illuminate\Http\UploadedFile;


class FuncionalidadTest extends TestCase
{
    /**
     * prueba de acceso a las vistas.
     *
     * @return void
     */
    public function test_funcionalidad()
    {
        //Archivos
        $user=User::find(1);
        $user_id=User::inRandomOrder()->first()->id;
        $response = $this->actingAs($user)->get('/permisos/'.$user_id);
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/archivo/'.$user_id);
        $response->assertStatus(200);
        
        $file=[
            'file'=>UploadedFile::fake()->image('photo1.jpg'),
        ];

        $user=User::find(2);
        $response = $this->actingAs($user)->post('/upload_file',$file);
        $response->assertStatus(302);
        
        $archivo_id=Archivo::where('user_id',$user->id)->get()->last()->first()->id;
        $response = $this->actingAs($user)->get('/delete_file/'.$archivo_id);
        $response->assertStatus(302);

        $file=[
            'file'=>UploadedFile::fake()->image('photo1.jpg'),
        ];

        $user_id=User::inRandomOrder()->first()->id;
        $user=User::find(1);
        $response = $this->actingAs($user)->post('/upload_file/'.$user_id,$file);
        $response->assertStatus(302);

        $archivo_id=Archivo::where('user_id',$user_id)->get()->last()->first()->id;
        $response = $this->actingAs($user)->get('/delete_file/'.$archivo_id.'/1');
        $response->assertStatus(302);

        //Permisos
        $permisos=[
            'permisos'=>[1,2],
            'user_id'=>$user_id
        ];
        
        echo "testing permisos \n";
        echo "user_id: ".$user_id." \n";
        $response = $this->actingAs($user)->post('/update_permisos',$permisos);
        $response->assertStatus(302);

    }
}
