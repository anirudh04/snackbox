<?php

use App\Company;
use App\CompanyTransformer;
use App\CompanyPlanTransformer;
use App\SingleCompanyTransformer;


use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

$app->get("/companies", function ($request, $response, $arguments) {
    $id=1;
    $companies = $this->spot->mapper("App\Company")
    ->query("SELECT companies.company_id,companies.logo,companies.rating,companies.name,companies.enrolled,companies.type FROM plans,companies,user_companies WHERE user_companies.company_id=companies.company_id AND user_companies.user_id=1");

    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);

    $resource = new Collection($companies, new CompanyTransformer);
    $data = $fractal->createData($resource)->toArray();

    return $response->withStatus(200)
    ->withHeader("Content-Type", "application/json")
    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});



$app->get("/company/{id}", function ($request, $response, $arguments) {

	if (false === $companies = $this->spot->mapper("App\Company")->first([
        "company_id" => $arguments["id"]
    ])) 
    {
        throw new NotFoundException(" Company not found.", 404);
    };

    if ($this->cache->isNotModified($request, $response)) {
        return $response->withStatus(304);
    }


    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer);
    $resource = new Item($companies, new SingleCompanyTransformer);
    $data = $fractal->createData($resource)->toArray();

    return $response->withStatus(200)
    ->withHeader("Content-Type", "application/json")
    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});


$app->post("/ratecompany/{id}", function ($request, $response, $arguments) {

	$body = [
     "user_id" => 1,
     "company_id" => $arguments["id"],
 ];

 $like = new Company_Rating($body);

 if (false === $check = $this->spot->mapper("App\Company_Rating")->first([
     "company_id" => $arguments["id"],
     "user_id" =>  1
 ])) 
 {
  $id = $this->spot->mapper("App\Company_Rating")->save($like);

  if ($id) {

     $data["status"] = "ok";
     $data["message"] = " rated ";

     return $response->withStatus(201)
     ->withHeader("Content-Type", "application/json")
     ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
 } else {

  $data["status"] = "error";
  $data["message"] = "Error in Rating!";

  return $response->withStatus(500)
  ->withHeader("Content-Type", "application/json")
  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
}

}
else {

  throw new NotFoundException("Already Bookmarked!", 404);
}
});