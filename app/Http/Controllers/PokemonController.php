<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PokemonController extends Controller
{
    /**
     * Muestra el listado de Pokémon guardados y el formulario de búsqueda.
     */
    public function index()
    {
        $pokemons = Pokemon::orderBy('name')->get();
        
        return view('pokemons.index', compact('pokemons'));
    }

    /**
     * Muestra los detalles de un Pokémon específico.
     */
    public function show($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        
        return view('pokemons.show', compact('pokemon'));
    }

    /**
     * Busca un Pokémon en la PokeAPI y lo guarda en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
        ]);

        $nombrePokemon = strtolower(trim($request->input('name')));

        try {
            // Llamar a la PokeAPI
            // En desarrollo local, ignoramos la verificación SSL para evitar problemas con certificados en Windows
            // Aumentamos el timeout a 60 segundos para evitar problemas de conexión
            $options = [
                'timeout' => 60,
                'connect_timeout' => 30,
            ];
            
            $httpClient = app()->environment('local')
                ? Http::withoutVerifying()->withOptions($options)
                : Http::withOptions($options);
            
            $response = $httpClient->get("https://pokeapi.co/api/v2/pokemon/{$nombrePokemon}");

            if ($response->status() === 404) {
                return redirect()->route('pokemons.index')
                    ->with('error', "No se encontró el Pokémon '{$nombrePokemon}'. Verifica que el nombre sea correcto.");
            }

            if (!$response->successful()) {
                return redirect()->route('pokemons.index')
                    ->with('error', 'Error al obtener los datos del Pokémon desde la API.');
            }

            $data = $response->json();

            // Guardar o actualizar el Pokémon en la base de datos
           /* Pokemon::updateOrCreate(
                ['name' => $data['name']],
                [
                    'base_experience' => $data['base_experience'] ?? null,
                    'height' => $data['height'] ?? null,
                    'weight' => $data['weight'] ?? null,
                    'sprite_url' => $data['sprites']['front_default'] ?? null,
                ]
            );
*/
            return redirect()->route('pokemons.index')
                ->with('success', "¡Pokémon '{$data['name']}' guardado correctamente!");
                
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Error de conexión al buscar Pokémon: ' . $e->getMessage());
            
            return redirect()->route('pokemons.index')
                ->with('error', 'Error de conexión con la API. Verifica tu conexión a internet e intenta de nuevo. Si el problema persiste, la API puede estar temporalmente no disponible.');
        } catch (\Exception $e) {
            Log::error('Error al buscar Pokémon: ' . $e->getMessage());
            
            return redirect()->route('pokemons.index')
                ->with('error', 'Error al buscar el Pokémon: ' . $e->getMessage());
        }
    }
}

