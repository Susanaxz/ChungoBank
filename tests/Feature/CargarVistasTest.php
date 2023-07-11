<?php

namespace Tests\Feature;

use Tests\TestCase;

class CargarVistasTest extends TestCase
{
    /**
     * Prueba la vista de la página de inicio
     */

    public function testCarga_Inicio(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)->assertViewIs('gestion');
    }

    /**
     * Prueba la vista de la página de alta de movimientos
     */
    public function testCarga_AltaMovimientos(): void
    {
        $response = $this->get('/alta-movimientos');

        $response->assertStatus(200)->assertViewIs('alta-movimientos');
    }
    /**
     * Prueba la vista de la página de alta de mantenimiento de puntos
     */

    public function carga_alta_mto_puntos()
    {
        // Crea una persona y guárdala en la base de datos.
        $persona = \App\Models\Personas::factory()->create();

        // Establece la 'idPersona' en la sesión.
        session(['idPersona' => $persona->id]);

        // Intenta acceder a la página.
        $response = $this->get('/alta-mto-puntos');

        $response->assertStatus(200);
    }
    /**
     * Prueba la vista de la página de alta de mantenimiento de puntos sin sesión
     */
    public function carga_alta_mto_puntos_sin_sesion() : void
    {
        // Borra la 'idPersona' de la sesión.
        session()->forget('idPersona');

        // Intenta acceder a la página.
        $response = $this->get('/alta-mto-puntos');

        $response->assertStatus(302);
    }


    /**
     * Prueba la vista de la página de alta de mantenimiento de puntos con sesión
     */
    public function carga_alta_mto_puntos_con_sesion() : void
    {
        // Crea una persona y la guarda en la base de datos.
        $persona = \App\Models\Personas::factory()->create();

        // Establece la 'idPersona' en la sesión.
        session(['idPersona' => $persona->id]);

        // Intenta acceder a la página.
        $response = $this->get('/alta-mto-puntos');

        $response->assertStatus(200);
    }

    
    /**
     * Prueba la vista de la página de consulta de movimientos
     */
    public function testCarga_ConsultaMovimientos(): void
    {
        $response = $this->get('/consulta-movimientos');

        $response->assertStatus(200)->assertViewIs('consulta-movimientos');
    }

    /**
     * Prueba la vista de la página de detalle de movimientos
     */
    public function testCarga_DetalleMovimiento(): void
    {
        $response = $this->get('/detalle-movimiento');

        $response->assertStatus(200)->assertViewIs('detalle-movimiento');
    }

    /**
     * Prueba la vista de la página de gestión
     */
    public function testCarga_Gestion(): void
    {
        $response = $this->get('/gestion');

        $response->assertStatus(200)->assertViewIs('gestion');
    }

    public function testCarga_GestionComercial(): void
    {
        $response = $this->get('/gestion');

        $response->assertStatus(200)->assertViewIs('gestion');
    }

    public function testCarga_GestionComercial_ConSesion(): void
    {
        // Crea una persona y la guarda en la base de datos.
        $persona = \App\Models\Personas::factory()->create();

        // Establece la 'idPersona' en la sesión.
        session(['idPersona' => $persona->id]);

        $response = $this->get('/gestion');

        $response->assertStatus(200)->assertViewIs('gestion');
    }
    public function testCarga_GestionComercial_SinSesion(): void
    {
        session()->forget('idPersona');

        $response = $this->get('/gestion');

        $response->assertStatus(302);
    }

    /**
     * Prueba la vista de la página de alta de personas
     */
    public function testCarga_AltaPersonas(): void
    {
        $response = $this->get('/alta-personas');

        $response->assertStatus(200)->assertViewIs('alta-personas');
    }

    public function testCarga_ConsultaMvtosCtaPuntos(): void
    {
        $response = $this->get('/consulta-movimientos');

        $response->assertStatus(200)->assertViewIs('consulta-movimientos');

}
}


