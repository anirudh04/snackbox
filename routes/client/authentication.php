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

use Response\NotFoundResponse;
use Response\ForbiddenResponse;
use Response\PreconditionFailedResponse;
use Response\PreconditionRequiredResponse;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

 
$app->post("/login", function ($request, $response, $arguments){


	$body = $request->getParsedBody();

	if ($check = $this->spot->mapper("App\User")
		->first(["google_id" => $body['google_id'],
			"email" =>  $body['email']]))
	{
		$data["type"] = "login";
		$now = new DateTime();
		$future = new DateTime("now +30 days");
		$server = $request->getServerParams();
	// $jti = Base62::encode(random_bytes(16));
		$payload = [
			"iat" => $now->getTimeStamp(),
			"exp" => $future->getTimeStamp(),
		// "jti" => $jti,
			"id" => $check->user_id,

		];
		$secret = getenv("JWT_SECRET");
		$token = JWT::encode($payload, $secret, "HS256");

		$data["registered"] = true;
		$data["token"] = $token;
		$data["status"] = $check->status;
		$data["id"] = $check->user_id;
		return $response->withStatus(201)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}
	else
	{
		$data["registered"] = false;
		$data["token"] = "0";
		$data["status"] = "rejected";
		return $response->withStatus(201)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}
});

