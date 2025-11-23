<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test que la página principal carga correctamente.
     */
    public function test_la_pagina_principal_carga_correctamente(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Tu Lista de Pokémon');
        $response->assertSee('Buscar');
    }

    /**
     * Test que se puede buscar y guardar un Pokémon desde la API.
     */
    public function test_se_puede_buscar_y_guardar_un_pokemon_desde_la_api(): void
    {
        // Simular respuesta de la PokeAPI
        Http::fake([
            'pokeapi.co/api/v2/pokemon/pikachu' => Http::response([
                'name' => 'pikachu',
                'base_experience' => 112,
                'height' => 4,
                'weight' => 60,
                'sprites' => [
                    'front_default' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png',
                ],
            ], 200),
        ]);

        // Verificar que no hay Pokémon inicialmente
        $this->assertEquals(0, Pokemon::count());

        // Enviar petición POST para buscar y guardar
        $response = $this->post('/pokemons', [
            'name' => 'pikachu',
        ]);

        // Verificar que se creó el Pokémon
        $this->assertEquals(1, Pokemon::count());

        $pokemon = Pokemon::first();
        $this->assertEquals('pikachu', $pokemon->name);
        $this->assertEquals(112, $pokemon->base_experience);
        $this->assertEquals(4, $pokemon->height);
        $this->assertEquals(60, $pokemon->weight);
        $this->assertStringContainsString('sprites', $pokemon->sprite_url);

        // Verificar redirección
        $response->assertRedirect(route('pokemons.index'));
    }

    /**
     * Test que maneja correctamente cuando un Pokémon no existe.
     */
    public function test_maneja_correctamente_cuando_un_pokemon_no_existe(): void
    {
        // Simular respuesta 404 de la PokeAPI
        Http::fake([
            'pokeapi.co/api/v2/pokemon/pokemon-inexistente' => Http::response([], 404),
        ]);

        $response = $this->post('/pokemons', [
            'name' => 'pokemon-inexistente',
        ]);

        // Verificar que no se creó ningún Pokémon
        $this->assertEquals(0, Pokemon::count());

        // Verificar redirección
        $response->assertRedirect(route('pokemons.index'));
    }

    /**
     * Test que muestra los Pokémon guardados en la página principal.
     */
    public function test_muestra_los_pokemons_guardados_en_la_pagina_principal(): void
    {
        // Crear algunos Pokémon de prueba
        Pokemon::create([
            'name' => 'pikachu',
            'base_experience' => 112,
            'height' => 4,
            'weight' => 60,
            'sprite_url' => 'https://example.com/pikachu.png',
        ]);

        Pokemon::create([
            'name' => 'bulbasaur',
            'base_experience' => 64,
            'height' => 7,
            'weight' => 69,
            'sprite_url' => 'https://example.com/bulbasaur.png',
        ]);

        // Hacer petición a la página principal
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('pikachu');
        $response->assertSee('bulbasaur');
        $response->assertSee('112');
        $response->assertSee('64');
    }

    /**
     * Test que actualiza un Pokémon existente si se busca de nuevo.
     */
    public function test_actualiza_un_pokemon_existente_si_se_busca_de_nuevo(): void
    {
        // Crear un Pokémon inicial
        Pokemon::create([
            'name' => 'pikachu',
            'base_experience' => 100,
            'height' => 4,
            'weight' => 60,
            'sprite_url' => 'https://example.com/old.png',
        ]);

        // Simular respuesta actualizada de la PokeAPI
        Http::fake([
            'pokeapi.co/api/v2/pokemon/pikachu' => Http::response([
                'name' => 'pikachu',
                'base_experience' => 112,
                'height' => 4,
                'weight' => 60,
                'sprites' => [
                    'front_default' => 'https://example.com/new.png',
                ],
            ], 200),
        ]);

        // Buscar el mismo Pokémon de nuevo
        $this->post('/pokemons', [
            'name' => 'pikachu',
        ]);

        // Verificar que solo hay un Pokémon (no se duplicó)
        $this->assertEquals(1, Pokemon::count());

        // Verificar que se actualizaron los datos
        $pokemon = Pokemon::first();
        $this->assertEquals(112, $pokemon->base_experience);
        $this->assertEquals('https://example.com/new.png', $pokemon->sprite_url);
    }
}

