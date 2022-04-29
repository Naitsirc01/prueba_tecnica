<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Archivo;
use Illuminate\Http\UploadedFile;


class RutasTest extends TestCase
{
    /**
     * prueba de acceso a las vistas.
     *
     * @return void
     */
    public function test_rutas()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $user=User::find(2);
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/archivo');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/historial');
        $response->assertStatus(200);

        $user=User::find(1);
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/archivo');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/historial');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/usuarios');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/historial_archivo_admin');
        $response->assertStatus(200);

    }
}
