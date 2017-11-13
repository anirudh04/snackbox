<?php



//namespace Tuupola\Http\Response;
namespace Response;

use Crell\ApiProblem\ApiProblem;
use Slim\Http\Headers;
use Slim\Http\Response;
use Slim\Http\Stream;

class NotFoundResponse extends Response
{
    public function __construct($message, $status = 404)
    {
        $problem = new ApiProblem(
            $message,
            "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html"
        );
        $problem->setStatus($status);

        $handle = fopen("php://temp", "wb+");
        $body = new Stream($handle);
        $body->write($problem->asJson(true));
        $headers = new Headers;
        $headers->set("Content-type", "application/problem+json");
        parent::__construct($status, $headers, $body);
    }
}
