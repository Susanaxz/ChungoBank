<?php

namespace Tests\Feature;

use App\Models\Personas;
use Tests\TestCase;

class PersonasTest extends TestCase
{


    public function testConsultaPersonasGestionComercial()
    {
        // Crear un nuevo objeto Persona con datos ficticios
        $persona = Personas::factory()->create();

        // Configurar la sesión para usar el ID de la nueva persona
        session(['idPersona' => $persona->id]);

        // Enviar una solicitud GET a '/personas'
        $response = $this->withSession(['idPersona' => $persona->id])
            ->get('/personas');

        // Verifica que el nif este en la respuesta
        $response->assertSeeText($persona->nif);
    }

    

    public function testConsultaPersonasGestionComercialNifVacio()
    {
        // Simula una sesión con un NIF vacío
        session(['nif' => '']);

        // Realiza la petición
        $response = $this->get('/personas');

        // Comprueba la respuesta esperada (status 302 = redirect a la página de login)
        $response->assertRedirect('gestion');
    }
    public function testConsultaPersonasGestionComercialNifInexistente()
    {
        // Simula una sesión con un NIF inexistente
        session(['nif' => '12345678Z']);

        // Realiza la petición
        $response = $this->get('/personas');

        // Comprueba la respuesta esperada
        $response->assertRedirect('gestion');
    }
    public function testConsultaPersonasGestionComercialNifValido()
    {
        $persona = Personas::factory()->create();

        // Simula una sesión con un NIF válido
        session(['nif' => $persona->nif]);

        // Realiza la petición
        $response = $this->get('/personas');

        // Comprueba que la respuesta es correcta y que contiene el NIF
        $response->assertOk();
        $response->assertSeeText($persona->nif);
    }

    public function testAltaPersonaNifSinInformar()
    {
        // Prepara los datos de prueba sin el campo 'nif'
        $datos = $this->getDatosPersona();
        unset($datos['nif']);

        // Realiza la petición
        $response = $this->post('/personas', $datos);

        // Comprueba que la respuesta muestra un error de validación
        $response->assertSessionHasErrors('nif');
    }

    public function testAltaPersonaNifDuplicado()
    {
        // Crea una persona en la base de datos
        $persona = Personas::factory()->create();

        // Prepara los datos de prueba con el mismo NIF que la persona creada
        $datos = $this->getDatosPersona();
        $datos['nif'] = $persona->nif;

        // Realiza la petición
        $response = $this->post('/personas', $datos);

        // Comprueba que la respuesta muestra un error de validación
        $response->assertSessionHasErrors('nif');
    }

    public function testAltaPersonaDatosValidos()
    {
        // Prepara los datos de prueba
        $datos = $this->getDatosPersona();

        // Realiza la petición
        $response = $this->post('/personas', $datos);

        // Comprueba que la respuesta es correcta
        $response->assertOk();

        // Comprueba que la persona se guardó correctamente en la base de datos
        $this->assertDatabaseHas('personas', $datos);
    }

    private function getDatosPersona()
    {
        $tarjeta = rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999);
        return [
            'nif' => '56434434G',
            'nombre' => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli avenue, 45',
            'email' => 'amerigo@mail.com',
            'tarjeta1' => substr($tarjeta, 0, 4),
            'tarjeta2' => substr($tarjeta, 4, 4),
            'tarjeta3' => substr($tarjeta, 8, 4),
            'tarjeta4' => substr($tarjeta, 12, 4),
        ];
    }
}
