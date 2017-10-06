<?php

use App\Plan;
use App\Company;
use App\Reviews;
use App\Likes;
use App\User;
use App\Bank_Details;
use App\Bank_DetailsTransformer;
use App\Discussion_Answers;
use App\Discussion_Questions;
use App\Discussion_AnswersTransformer;
use App\Discussion_QuestionsTransformer;
use App\User_CompaniesTransformer;
use App\ReviewsTransformer;
use App\PlanTransformer;
use App\My_Plans;
use App\My_PlansTransformer;
use App\SinglePlanTransformer;

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

  $id =1;
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

  $id =2;
  $my_plans = $this->spot->mapper("App\My_Plans")
  ->query("SELECT my_plans.plan_id,plans.name,my_plans.status,companies.logo FROM my_plans,plans,companies WHERE my_plans.plan_id=plans.plan_id AND companies.company_id=plans.company_id AND my_plans.user_id=$id AND my_plans.status IS NOT NULL");


  $fractal = new Manager();
  $fractal->setSerializer(new DataArraySerializer);

  $resource = new Collection($my_plans, new My_PlansTransformer);
  $data = $fractal->createData($resource)->toArray();

  return $response->withStatus(200)
  ->withHeader("Content-Type", "application/json")
  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});


$app->post("/reviewPlan/{id}", function ($request, $response, $arguments) {
  $body = $request->getParsedBody();


  $planreview['plan_id'] =  $arguments["id"];
  $planreview['user_id'] = 2;
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

 $body = $request->getParsedBody();
 $discussquestion['user_id'] = 2;
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

 $body = $request->getParsedBody();
 $discussquestion['plan_id'] =  $arguments["id"];
 $discussquestion['user_id'] =2;
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

 $body = [
   "user_id" => 1,
   "plan_id" => $arguments["plan_id"],
 ];

 $like = new Likes($body);

 if (false === $check = $this->spot->mapper("App\Likes")->first([
   "plan_id" => $arguments["plan_id"],
   "user_id" =>  1
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

  throw new NotFoundException("Already Bookmarked!", 404);
}
});


$app->post("/registerPlan/{plan_id}", function ($request, $response, $arguments) {

 $body = [
   "user_id" => 2,
   "plan_id" => $arguments["plan_id"],
   "status"=>'Waiting'
 ];

 $my_plans = new My_Plans($body);

 if (false === $check = $this->spot->mapper("App\My_Plans")->first([
   "plan_id" => $arguments["plan_id"],
   "user_id" =>  2,

 ])) 
 {
  $id = $this->spot->mapper("App\My_Plans")->save($my_plans);

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

  throw new NotFoundException("Already Bookmarked!", 404);
}
});


// $app->post("/bank_detail/{id}", function ($request, $response, $arguments) 
// {

//    $body = $request->getParsedBody();
//    $bankdetails['user_id'] =  $arguments["id"];
//    $bankdetails['holder_name'] =$body['holder_name'];
//    $bankdetails['bank_name'] = $body['bank_name'];
//    $bankdetails['ifsc'] = $body['ifsc'];
//    $bankdetails['account_number'] = $body['account_number'];
//    $bankdetails['pan_number'] = $body['pan_number'];

//    $newresponse = new Bank_Details($bankdetails);
//    $mapper = $this->spot->mapper("App\Bank_Details");
//    $id = $mapper->save($newresponse);

//    if ($id) {

//      /* Serialize the response data. */
//      $fractal = new Manager();
//      $fractal->setSerializer(new DataArraySerializer);

//      $entity = $mapper->where(["bank_id"=>$id]);

//      $data["status"] = "ok";
//      $data["id"] = $id;
//      $data["message"] = "Bank details successfully updated";

//      $resource = new Collection($entity, new Bank_DetailsTransformer());
//      $data["response"] = $fractal->createData($resource)->toArray()['data'][0];

//      return $response->withStatus(201)
//      ->withHeader("Content-Type", "application/json")
//      ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
//    } 
// else {

//     $data["status"] = "error";
//     $data["message"] = "Error in inserting!";

//     return $response->withStatus(500)
//     ->withHeader("Content-Type", "application/json")
//     ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
//   }
// });



