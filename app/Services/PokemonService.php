<?php

namespace App\Services;

use GuzzleHttp\Client;

class PokemonService
{
  public const API_BASE_URL = '/pokemon';
  public const LIMIT        = 150;
  public const OPTIONS      =  [
    'headers' => [
            'content-type'  => 'application/json',
            'Accept'        => 'application/json',
        ]
    ];
  
  /**
   * getPokemonsPage: retrieve pokemons list by offset.
   *
   * @param  int $offset
   * @return array $response
   */
  public static function getPokemonsPage(int $offset) : array {

    $client = new Client();

    $guzzleResponse = $client->get(env('POKEMON_HOST').self::API_BASE_URL.'?offset='.$offset. '&limit='.self::LIMIT, self::OPTIONS);
  
    if ($guzzleResponse->getStatusCode() != 200) {
        return response()->json([
            'error', 
            'status'  => $guzzleResponse->getStatusCode(), 
            'message' => $guzzleResponse->getReasonPhrase() 
        ]);
    }

    $response = json_decode($guzzleResponse->getBody(),true);

    return $response;

  }
  
  /**
   * getPokemonById : display pokemon details by id
   *
   * @param  string $name
   * @return array
   */
  public static function getPokemonByName(string $name) : array {

    $client = new Client();

    $guzzleResponse = $client->get(env('POKEMON_HOST').self::API_BASE_URL.'/'.$name, self::OPTIONS);
  
    if ($guzzleResponse->getStatusCode() != 200) {
        return response()->json([
            'error', 
            'status'  => $guzzleResponse->getStatusCode(), 
            'message' => $guzzleResponse->getReasonPhrase() 
        ]);
    }

    $data = json_decode($guzzleResponse->getBody(),true);
   
    // Build response array
    $response = [];
    $response['name']    = (string) @$data['name'];
    $response['weight']  = (int) @$data['weight'];
    $response['height']  = (int) @$data['height'];
    $response['types']   = self::getTypes($data);
    $response['image']   = self::getB64Image($data);

    return $response;

  }
  
  /**
   * getB64Image :  get Image by given URL and encode it.
   *
   * @param  int $url
   * @return string
   */
  private static function getB64Image(array $data) : string {

    $url = (string) @$data['sprites']['front_default'];

    // Check url 
    if (empty($url)){
        return '';
    }

    $client  = new Client();
    $content =  $client->get($url)->getBody()->getContents();

    return base64_encode($content);
   
  }
  
  /**
   * getTypes: retrieve pokemon types
   *
   * @param  array $data
   * @return array
   */
  private static function getTypes(array $data) : array {

    $types = [];
    foreach($data['types'] as $element) {
      if (empty(@$element['type']['name'])) {
        continue;
      }

      $types[] = @$element['type']['name'];
    }

    return $types;

  }

}
