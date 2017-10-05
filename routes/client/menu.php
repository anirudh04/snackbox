<?php

use App\User;
use App\Bank_Details;
use App\User_detailTransformer;
use App\Bank_DetailsPlanTransformer;

use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

$app->get("/details", function ($request, $response, $arguments) {

	$details = $this->spot->mapper("App\User")
        ->all();

    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);

    $resource = new Collection($details, new User_DetailTransformer);
    $data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});



$app->get("/detail/{id}", function ($request, $response, $arguments) {
if (false === $plans = $this->spot->mapper("App\User")->first([
        "user_id" => $arguments["id"]
    ])) 
{
        throw new NotFoundException(" Plan not found.", 404);
    };

    if ($this->cache->isNotModified($request, $response)) {
        return $response->withStatus(304);
    }


    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);
    $resource = new Item($plans, new User_DetailTransformer);
    $data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});


$app->post("/registerPlan/{id}", function ($request, $response, $arguments) {

	$data->message = "success";

	return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->post("/likePlan/{id}", function ($request, $response, $arguments) {

	$data->message = "success";

	return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->post("/reviewPlan/{id}", function ($request, $response, $arguments) {

	$data->message = "success";

	return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->post("/discussPlan/{id}", function ($request, $response, $arguments) {

	$data->message = "success";

	return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});
