<?php



date_default_timezone_set("UTC");
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

require __DIR__ . "/vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$abc = array();

$abc=[
    "settings" => [
        "displayErrorDetails" => true,
        "addContentLengthHeader" => false
    ]
];
$app = new \Slim\App($abc);

require __DIR__ . "/config/dependencies.php";
require __DIR__ . "/config/handlers.php";
require __DIR__ . "/config/middleware.php";

$app->get("/", function ($request, $response, $arguments) {
    print "Here be dragons";
});

require __DIR__ . "/routes/token.php";
require __DIR__ . "/routes/todos.php";
require __DIR__ . "/routes/client/plans.php";
require __DIR__ . "/routes/client/machines.php";
require __DIR__ . "/routes/client/planActions.php";
require __DIR__ . "/routes/client/home.php";
require __DIR__ . "/routes/client/orders.php";
require __DIR__ . "/routes/client/user.php";
require __DIR__ . "/routes/client/authentication.php";

$app->run();
