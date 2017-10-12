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


$app->post("/reviewPlan/{id}", function ($request, $response, $arguments) {
	$body = $request->getParsedBody();


	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));

	$planreview['plan_id'] =  $arguments["id"];
	$planreview['user_id'] = $decoded_token->id;
	$planreview['name'] = $body['title'];
	$planreview['message'] = $body['message'];

	$newresponse = new Reviews($planreview);
	$mapper = $this->spot->mapper("App\Reviews");
	$id = $mapper->save($newresponse);

	if ($id) {

		/* Serialize the response data. */
		$fractal = new Manager();
		$fractal->setSerializer(new DataArraySerializer);

		$entity = $mapper->where(["review_id"=>$id]);

		$data["status"] = "ok";
		$data["id"] = $id;
		$data["message"] = "Review added";

		$resource = new Collection($entity, new ReviewsTransformer());
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
});

$app->post("/discussPlanAnswer/{question_id}", function ($request, $response, $arguments) 
{ 
	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));

	$body = $request->getParsedBody();
	$discussquestion['user_id'] = $$decoded_token->id;
	$discussquestion['question_id'] =  $arguments["question_id"];
	$discussquestion['answer'] = $body['answer'];

	$newresponse = new Discussion_Answers($discussquestion);
	$mapper = $this->spot->mapper("App\Discussion_Answers");
	$id = $mapper->save($newresponse);

	if ($id) {

		/* Serialize the response data. */
		$fractal = new Manager();
		$fractal->setSerializer(new DataArraySerializer);

		$entity = $mapper->where(["answer_id"=>$id]);

		$data["status"] = "ok";
		$data["id"] = $id;
		$data["message"] = "Answer added";

		$resource = new Collection($entity, new Discussion_AnswersTransformer());
		$data["response"] = $fractal->createData($resource)->toArray()['data'][0];

		return $response->withStatus(201)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	} 
	else {

		$data["status"] = "error";
		$data["message"] = "Error in inserting!";

		return $response->withStatus(500)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}
});

$app->post("/discussPlanQuestion/{id}", function ($request, $response, $arguments) 
{


	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));

	$body = $request->getParsedBody();
	$discussquestion['plan_id'] =  $arguments["id"];
	$discussquestion['user_id'] =$decoded_token->id;
	$discussquestion['question'] = $body['question'];

	$newresponse = new Discussion_Questions($discussquestion);
	$mapper = $this->spot->mapper("App\Discussion_Questions");
	$id = $mapper->save($newresponse);

	if ($id) {

		/* Serialize the response data. */
		$fractal = new Manager();
		$fractal->setSerializer(new DataArraySerializer);

		$entity = $mapper->where(["question_id"=>$id]);

		$data["status"] = "ok";
		$data["id"] = $id;
		$data["message"] = "Question added";

		$resource = new Collection($entity, new Discussion_QuestionsTransformer());
		$data["response"] = $fractal->createData($resource)->toArray()['data'][0];

		return $response->withStatus(201)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	} 
	else {

		$data["status"] = "error";
		$data["message"] = "Error in inserting!";

		return $response->withStatus(500)
		->withHeader("Content-Type", "application/json")
		->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}
});

$app->post("/likePlan/{plan_id}", function ($request, $response, $arguments)
{
	$token = $request->getHeader('authorization');
	$token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$token = $JWT->decodeToken($JWT->fetchToken($request));


	$body = [
		"user_id" => $decoded_token->id,
		"plan_id" => $arguments["plan_id"],
	];

	$like = new Likes($body);

	if (false === $check = $this->spot->mapper("App\Likes")->first([
		"plan_id" => $arguments["plan_id"],
		"user_id" =>  $decoded_token->id
	])) 
	{
		$id = $this->spot->mapper("App\Likes")->save($like);

		if ($id) {

			$data["status"] = "ok";
			$data["message"] = " like ";

			return $response->withStatus(201)
			->withHeader("Content-Type", "application/json")
			->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
		} else {

			$data["status"] = "error";
			$data["message"] = "Error in liking!";

			return $response->withStatus(500)
			->withHeader("Content-Type", "application/json")
			->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
		}

	}
	else {

		throw new NotFoundException("Already Liked!", 404);
	}
});

$app->post("/registerPlan/{plan_id}/{company_id}", function ($request, $response, $arguments) {


	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));

	$body = [
		"user_id" => $decoded_token->id,
		"plan_id" => $arguments["plan_id"],
		"company_id"=>$arguments["company_id"],
		"status"=>'Waiting'
	];

	$my_plans = new My_Plans($body);

	if (false === $check = $this->spot->mapper("App\My_Plans")->first(["plan_id" => $arguments["plan_id"],"user_id" =>  $decoded_token->id])) 

	{
		$id = $this->spot->mapper("App\My_Plans")->save($my_plans);


		if ($id) {

			$data["status"] = "ok";
			$data["message"] = " registered ";

			$user_id=$token->user_id;
			$message1="User with user id ";
			$message2=" has registered in plan with plan id ";
			$plan_id=$arguments["plan_id"];

			$body = $request->getParsedBody();
			$usernotification['user_id'] =  $decoded_token->id;
			$usernotification['plan_reg_id'] =$arguments["plan_id"];
			$usernotification['un_notification'] = "$message1$user_id$message2$plan_id" ;
			$usernotification['company_id'] =$arguments["company_id"];			$newresponse = new UserNotification($usernotification);
			$mapper = $this->spot->mapper("App\UserNotification");
			$id = $mapper->save($newresponse);


			return $response->withStatus(201)
			->withHeader("Content-Type", "application/json")
			->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
		} 
		else {

			$data["status"] = "error";
			$data["message"] = "Error in liking!";

			return $response->withStatus(500)
			->withHeader("Content-Type", "application/json")
			->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
		}

	}
	else {

		throw new NotFoundException("Already registered!", 200);
	}
});
