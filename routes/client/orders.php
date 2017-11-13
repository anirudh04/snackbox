<?php

use App\Machine_Orders;
use App\Machine_OrdersTransformer;
use App\Machine_Items;
use App\Machine_ItemsTransformer;
use App\Machine_Order_ItemsTransformer;

use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;
use Exception\NotFoundException;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

$app->get("/order/{id}", function ($request, $response, $arguments) {

   $id=$arguments["id"];

    // $token = $request->getHeader('Authorization');
    // $decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
    // $JWT = $this->get('JwtAuthentication');
    // $decoded_token = $JWT->decodeToken($JWT->fetchToken($request));



    // $id=$decoded_token->id;
    $items = $this->spot->mapper("App\Machine_Order_Items")
        ->all()
        ->where(["order_id" => $id]);


    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);

    $resource = new Collection($items, new Machine_Order_ItemsTransformer);
    $data = $fractal->createData($resource)->toArray();
    return $response->withStatus(200)
    ->withHeader("Content-Type", "application/json")
    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->get("/orders", function ($request, $response, $arguments) {


  // $token = $request->getHeader('Authorization');
  // $decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
  // $JWT = $this->get('JwtAuthentication');
  // $decoded_token = $JWT->decodeToken($JWT->fetchToken($request));



  // $id=$decoded_token->id;
  $order = $this->spot->mapper("App\Machine_Orders")
        ->all();

  $fractal = new Manager();
  $fractal->setSerializer(new DataArraySerializer);

  $resource = new Collection($order, new Machine_OrdersTransformer);
  $data = $fractal->createData($resource)->toArray();
  return $response->withStatus(200)
  ->withHeader("Content-Type", "application/json")
  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

