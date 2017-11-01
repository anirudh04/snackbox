<?php

use App\Machines;
use App\MachinesTransformer;
use App\Machine_Items;
use App\Machine_ItemsTransformer;

use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;
use Exception\NotFoundException;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

$app->get("/machine/{id}", function ($request, $response, $arguments) {

   $id=$arguments["id"];

    // $token = $request->getHeader('Authorization');
    // $decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
    // $JWT = $this->get('JwtAuthentication');
    // $decoded_token = $JWT->decodeToken($JWT->fetchToken($request));



    // $id=$decoded_token->id;
    $items = $this->spot->mapper("App\Machine_Items")->query("SELECT name,pos,row_tag,price,left_units,tot_units FROM machine_items WHERE mc_id=$id");

    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);

    $resource = new Collection($items, new Machine_ItemsTransformer);
    $data = $fractal->createData($resource)->toArray();
    return $response->withStatus(200)
    ->withHeader("Content-Type", "application/json")
    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->get("/machines", function ($request, $response, $arguments) {


  // $token = $request->getHeader('Authorization');
  // $decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
  // $JWT = $this->get('JwtAuthentication');
  // $decoded_token = $JWT->decodeToken($JWT->fetchToken($request));



  // $id=$decoded_token->id;
  $machine = $this->spot->mapper("App\Machines")->query("SELECT id,area_city,city,tot_units,left_units FROM machines WHERE local_admin_name='Anirudh'");

  $fractal = new Manager();
  $fractal->setSerializer(new DataArraySerializer);

  $resource = new Collection($machine, new MachinesTransformer);
  $data = $fractal->createData($resource)->toArray();
  return $response->withStatus(200)
  ->withHeader("Content-Type", "application/json")
  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

