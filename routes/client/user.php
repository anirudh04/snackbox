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



$app->get("/user", function ($request, $response, $arguments) 
{


	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$token = $JWT->decodeToken($JWT->fetchToken($request));


	$id =$token->id;

	$user = $this->spot->mapper("App\User")->query("SELECT * FROM user WHERE user_id=$id");


	$fractal = new Manager();
	$fractal->setSerializer(new DataArraySerializer);
	$resource = new Collection($user, new User_DetailTransformer);
	$data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)

	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->post("/bank_detail", function ($request, $response, $arguments) 
{


	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$token = $JWT->decodeToken($JWT->fetchToken($request));


	$id =$token->id;

	$body = $request->getParsedBody();
	$bankdetails['user_id'] =  $id;
	$bankdetails['holder_name'] =$body['holder_name'];
	$bankdetails['bank_name'] = $body['bank_name'];
	$bankdetails['ifsc'] = $body['ifsc'];
	$bankdetails['account_number'] = $body['account_number'];
	$bankdetails['pan_number'] = $body['pan_number'];


	if ($check = $this->spot->mapper("App\Bank_Details")->first([
		"user_id" => $id
	]))
	{
		throw new NotFoundException("Already added!", 404);
	}
	else{


		$newresponse = new Bank_Details($bankdetails);
		$mapper = $this->spot->mapper("App\Bank_Details");
		$id = $mapper->save($newresponse);

		if ($id) {

			/* Serialize the response data. */
			$fractal = new Manager();
			$fractal->setSerializer(new DataArraySerializer);

			$entity = $mapper->where(["bank_id"=>$id]);

			$data["status"] = "ok";
			$data["id"] = $id;
			$data["message"] = "bank details added";

			$resource = new Collection($entity, new Bank_DetailsTransformer());
			$data["response"] = $fractal->createData($resource)->toArray()['data'][0];

			return $response->withStatus(201)
			->withHeader("Content-Type", "application/json")
			->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
		} 
		else
		{

			$data["status"] = "error";
			$data["message"] = "Error in inserting!";

			return $response->withStatus(500)
			->withHeader("Content-Type", "application/json")
			->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
		}
	}
});

$app->post("/signup", function ($request, $response, $arguments) 
{


 //    $token = $request->getHeader('Authorization');
	// $decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	// $JWT = $this->get('JwtAuthentication');
	// $decoded_token = $JWT->decodeToken($JWT->fetchToken($request));

	$body = $request->getParsedBody();

	$user['user_name'] = $body['user_name'];
	$user['college'] = $body['college'];
	$user['google_id'] = $body['google_id'];
	$user['gender'] = $body['gender'];
	$user['email'] = $body['email'];
	$user['phone'] = $body['phone'];
	$user['address'] = $body['address'];
	$user['degree'] = $body['degree'];
	$user['cv'] = $body['cv'];


	$newresponse = new User($user);
	$mapper = $this->spot->mapper("App\User");
	$id = $mapper->save($newresponse);


	if ($id) {
		$check = $this->spot->mapper("App\User")
		->first(["google_id" => $body['google_id'],
			"email" =>  $body['email']]);

		
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


		/* Serialize the response data. */
		$fractal = new Manager();
		$fractal->setSerializer(new DataArraySerializer);

		$entity = $mapper->where(["user_id"=>$id]);

		$data["status"] = "ok";
		
		$data["token"] = $token;
		$data["message"] = "User details added";

		$resource = new Collection($entity, new User_DetailTransformer());
		$data["response"] = $fractal->createData($resource)->toArray()['data'][0];


		$message1=" A new user has registered";		
		$body = $request->getParsedBody();
		$userregnotification['user_id'] =  $check->user_id;
		$userregnotification['user_reg_notification'] ="$message1";


		$newresponse = new User_RegistrationNotification($userregnotification);
		$mapper = $this->spot->mapper("App\User_RegistrationNotification");
		$id = $mapper->save($newresponse);	
		return $response->withStatus(201)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}

	else
	{

		$data["status"] = "error";
		$data["message"] = "Error in inserting!";

		return $response->withStatus(500)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}
});

$app->get("/checkstatus", function ($request, $response, $arguments) 
{

	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));


	$id =$decoded_token->id;
	$user = $this->spot->mapper("App\User")
	->query("SELECT status FROM user WHERE user_id=$id")->first();

	$data["registered"] = true;
	$data["token"] = $token;
	$data["status"] = $user->status;


	return $response->withStatus(200)
	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});
