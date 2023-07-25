<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        
    /**
     * dashboard
     *
     * @param  mixed $offset
     * @return JsonResponse
     */
    public function dashboard(int $offset) :JsonResponse {
        
        return response()->json(PokemonService::getPokemonsPage($offset, PokemonService::LIMIT));
    }

    /**
     * Dsiplay pokemon details by given id.
     *
     * @param  string $name
     * @return array
     */
    public function displayPokemon(string $name) : JsonResponse {

        return response()->json(PokemonService::getPokemonByName($name));
    } 

    
}
