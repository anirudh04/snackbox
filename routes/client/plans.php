<?php

use App\Plan;
use App\Company;
use App\Reviews;
use App\Likes;
use Tuupola\Base62;
use Firebase\JWT\JWT;
use App\UserNotification;
use App\User;
use App\Bank_Details;
use App\Bank_DetailsTransformer;
use App\User_RegistrationNotification;
use App\Discussion_Answers;
use App\Discussion_Questions;
use App\Discussion_AnswersTransformer;
use App\Discussion_QuestionsTransformer;
use App\User_CompaniesTransformer;
use App\ReviewsTransformer;
use App\PlanTransformer;
use App\User_DetailTransformer;
use App\My_Plans;
use App\My_PlansTransformer;
use App\SinglePlanTransformer;
use App\HomeTransformer;

use Exception\NotFoundException;

use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

$app->get("/plans", function ($request, $response, $arguments) 
          {	$token = $request->getHeader('Authorization');
          $decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
          $JWT = $this->get('JwtAuthentication');
          $decoded_token = $JWT->decodeToken($JWT->fetchToken($request));	$id =$decoded_token->id;
          $plans = $this->spot->mapper("App\Plan")
          ->query("SELECT plans.plan_id,plans.name,plans.price_of_product,plans.difficulty,companies.logo FROM plans,companies,user_companies WHERE user_companies.company_id=companies.company_id AND companies.company_id=plans.company_id AND user_companies.user_id=$id");

          $fractal = new Manager();
          $fractal->setSerializer(new DataArraySerializer);

          $resource = new Collection($plans, new PlanTransformer);
          $data = $fractal->createData($resource)->toArray();

          return $response->withStatus(200)
          ->withHeader("Content-Type", "application/json")
          ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
      });

$app->get("/plan/{id}", function ($request, $response, $arguments) 
{
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

$app->get("/myplans", function ($request, $response, $arguments) 
{

	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));


	$id =$decoded_token->id;
	$my_plans = $this->spot->mapper("App\My_Plans")
	->query("SELECT my_plans.plan_id,plans.name,my_plans.status,companies.logo FROM my_plans,plans,companies WHERE my_plans.plan_id=plans.plan_id AND companies.company_id=plans.company_id AND my_plans.user_id=$id ");


	$fractal = new Manager();
	$fractal->setSerializer(new DataArraySerializer);
	$resource = new Collection($my_plans, new My_PlansTransformer);
	$data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)
	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->get("/discussionAnswer/{id}", function ($request, $response, $arguments) 
{

	if (false === $answers = $this->spot->mapper("App\Discussion_Answers")
	    ->where(["question_id" => $arguments["id"]]) ) 
	{
		throw new NotFoundException("Question not found.", 404);
	};

	if ($this->cache->isNotModified($request, $response)) {
		return $response->withStatus(304);
	}

	if (count($answers) == 0) {
		throw new NotFoundException("No answers", 404);
	}

	$fractal = new Manager();
	$fractal->setSerializer(new DataArraySerializer);
	$resource = new Collection($answers, new Discussion_AnswersTransformer);
	$data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)
	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});
