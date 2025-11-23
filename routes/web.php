<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', [PokemonController::class, 'index'])->name('pokemons.index');
Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');
Route::get('/pokemons/{id}', [PokemonController::class, 'show'])->name('pokemons.show');
