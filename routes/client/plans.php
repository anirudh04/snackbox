<?php

use App\Plan;
use App\Company;
use App\User_Companies;
use App\PlanTransformer;
use App\SinglePlanTransformer;

use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

$app->get("/plans", function ($request, $response, $arguments) {

    $id =1;
    $plans = $this->spot->mapper("App\Plan")
    ->query("SELECT * FROM plans, companies,user_companies WHERE user_companies.company_id=companies.company_id AND companies.company_id=plans.company_id AND user_companies.user_id=1");


    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);

    $resource = new Collection($plans, new PlanTransformer);
    $data = $fractal->createData($resource)->toArray();

    return $response->withStatus(200)
    ->withHeader("Content-Type", "application/json")
    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});



$app->get("/plan/{id}", function ($request, $response, $arguments) {
    if (false === $plans = $this->spot->mapper("App\Plan")->first([
        "plan_id" => $arguments["id"]
    ])) 
    {
        throw new NotFoundException(" Plan not found.", 404);
    };

    if ($this->cache->isNotModified($request, $response)) {
        return $response->withStatus(304);
    }


    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);
    $resource = new Item($plans, new SinglePlanTransformer);
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
