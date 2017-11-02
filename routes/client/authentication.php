<?php
use App\Business_Admin;

use Tuupola\Base62;
use Firebase\JWT\JWT;

use Exception\NotFoundException;
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

    if ($check = $this->spot->mapper("App\Business_Admin")
        ->first(["email" => $body['email'],
            "password" =>  $body['password']]))
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
            "email" => $check->email,

        ];
        $secret = getenv("JWT_SECRET");
        $token = JWT::encode($payload, $secret, "HS256");

        $data["registered"] = true;
        $data["token"] = $token;
        $data["status"] = $check->status;
        $data["email"] = $check->email;
        $data["id"] = $check->id;
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

