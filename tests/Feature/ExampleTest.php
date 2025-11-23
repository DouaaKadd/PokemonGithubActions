<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test básico de ejemplo.
     */
    public function test_la_aplicacion_responde_correctamente(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
