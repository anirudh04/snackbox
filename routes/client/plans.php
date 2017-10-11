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

$app->get("/plans", function ($request, $response, $arguments) 
{


	$token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));



	$id =$decoded_token->id;
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


$app->get("/home/{id}", function ($request, $response, $arguments) 
{

	$id =$arguments["id"];
	$user = $this->spot->mapper("App\User")->query("SELECT user.user_id,user.user_name,COUNT(my_plans.plan_id) FROM user,my_plans WHERE user.user_id=my_plans.user_id AND user.user_id=$id AND my_plans.status='accepted'" );


	$fractal = new Manager();
	$fractal->setSerializer(new DataArraySerializer);

	$resource = new Collection($user, new HomeTransformer);
	$data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)
	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->get("/user/{id}", function ($request, $response, $arguments) 
{

	$id =$arguments["id"];
	$user = $this->spot->mapper("App\User")->query("SELECT * FROM user WHERE user_id=$id");


	$fractal = new Manager();
	$fractal->setSerializer(new DataArraySerializer);
	$resource = new Collection($user, new User_DetailTransformer);
	$data = $fractal->createData($resource)->toArray();

	return $response->withStatus(200)

	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});


// $app->get("/user_detail/{id}", function ($request, $response, $arguments) 
// {
// 	if (false === $user = $this->spot->mapper("App\User")->first([
// 		"user_id" => $arguments["id"]
// 	])) 
// 	{
// 		throw new NotFoundException(" user not found.", 404);
// 	};

// 	if ($this->cache->isNotModified($request, $response)) {
// 		return $response->withStatus(304);
// 	}

// 	$fractal = new Manager();
// 	$fractal->setSerializer(new DataArraySerializer);
// 	$resource = new Item($user, new User_DetailTransformer);
// 	$data = $fractal->createData($resource)->toArray();

// 	return $response->withStatus(200)
// 	->withHeader("Content-Type", "application/json")
// 	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });

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



$app->post("/likePlan/{plan_id}", function ($request, $response, $arguments) {


     
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


$app->post("/registerPlan/{plan_id}", function ($request, $response, $arguments) {

      
   $token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));


	$body = [
		"user_id" => $decoded_token->id,
		"plan_id" => $arguments["plan_id"],
		"status"=>'Waiting'
	];

	$my_plans = new My_Plans($body);

	if (false === $check = $this->spot->mapper("App\My_Plans")->first(["plan_id" => $arguments["plan_id"],"user_id" =>  2])) 

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
			$usernotification['user_id'] =  $token->user_id;
			$usernotification['plan_reg_id'] =$arguments["plan_id"];
			$usernotification['un_notification'] = "$message1$user_id$message2$plan_id" ;



			$newresponse = new UserNotification($usernotification);
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

		throw new NotFoundException("Already Bookmarked!", 404);
	}
});



$app->post("/bank_detail/{id}", function ($request, $response, $arguments) 
{

	$body = $request->getParsedBody();
	$bankdetails['user_id'] =  $arguments["id"];
	$bankdetails['holder_name'] =$body['holder_name'];
	$bankdetails['bank_name'] = $body['bank_name'];
	$bankdetails['ifsc'] = $body['ifsc'];
	$bankdetails['account_number'] = $body['account_number'];
	$bankdetails['pan_number'] = $body['pan_number'];


	if ($check = $this->spot->mapper("App\Bank_Details")->first([
		"user_id" => $arguments["id"]
	]))
	{
		throw new NotFoundException("Already Bookmarked!", 404);
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



$app->post("/userdetail", function ($request, $response, $arguments) 
{


    $token = $request->getHeader('Authorization');
	$decoded_token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$decoded_token = $JWT->decodeToken($JWT->fetchToken($request));

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

		/* Serialize the response data. */
		$fractal = new Manager();
		$fractal->setSerializer(new DataArraySerializer);

		$entity = $mapper->where(["user_id"=>$id]);

		$data["status"] = "ok";
		$data["id"] = $id;
		$data["message"] = "User details added";

		$resource = new Collection($entity, new User_DetailTransformer());
		$data["response"] = $fractal->createData($resource)->toArray()['data'][0];



		$message1=" A new user has registered";



		$body = $request->getParsedBody();
		$userregnotification['user_id'] =  $token->user_id;
		$userregnotification['user_reg_notification'] ="$message1";


		$newresponse = new User_RegistrationNotification($userregnotification);
		$mapper = $this->spot->mapper("App\User_RegistrationNotification");
		$id = $mapper->save($newresponse);





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

$app->post("/login", function ($request, $response, $arguments){


	$body = $request->getParsedBody();



	if ($check = $this->spot->mapper("App\User")
		->first(["google_id" => $body['google_id'],
			"email" =>  $body['email']])){
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





















