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

$app->get("/home", function ($request, $response, $arguments) 
{


	$token = $request->getHeader('Authorization');
	$token = substr($token[0], strpos($token[0], " ") + 1); 
	$JWT = $this->get('JwtAuthentication');
	$token = $JWT->decodeToken($JWT->fetchToken($request));


	$id =$token->id;

	$user = $this->spot->mapper("App\User")->query("SELECT user_id,user_name FROM user WHERE user_id=$id");

	$accepted = $this->spot->mapper("App\My_Plans")->query("SELECT COUNT(my_plans.plan_id) AS abc FROM user,my_plans WHERE  my_plans.user_id =user.user_id AND my_plans.status='accepted' AND user.user_id=$id");

	// $my_plans = $this->spot->mapper("App\My_Plans")->query("SELECT COUNT(my_plans.plan_id) FROM user,my_plans WHERE  my_plans.user_id =user.user_id AND user.user_id=$id");

	$amount = $this->spot->mapper("App\My_Plans")->query("SELECT SUM(my_plans.amount) AS cba FROM user,my_plans WHERE  my_plans.user_id =user.user_id AND my_plans.status='accepted' AND user.user_id=$id");

	// $accepted= (object)$accepted;
	$accepted= $accepted[0]->abc;
	$amount= $amount[0]->cba;
	// $my_plans=$my_plans[0]->;


	$fractal = new Manager();
	$fractal->setSerializer(new DataArraySerializer);

	$resource = new Collection($user, new HomeTransformer);
	$data = $fractal->createData($resource)->toArray();

	// $data->my_plans=$my_plans;
	$data["data"][0]['accepted']=(int)$accepted;
	$data["data"][0]['amount']=(int)$amount;
	// $data->accepted="$accepted";
	// $data[1]->amount=$amount;

	return $response->withStatus(200)
	->withHeader("Content-Type", "application/json")
	->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});
