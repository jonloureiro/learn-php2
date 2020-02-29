<?php ini_set("display_errors", 1);

use MinhasHoras\App;
use MinhasHoras\Http\Emitter;
use MinhasHoras\Http\ResponseFactory;
use MinhasHoras\Http\ServerRequestFactory;
use MinhasHoras\Route\ApiRouter;
use MinhasHoras\Api\Hello\HelloController;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

$serverRequestFactory = new ServerRequestFactory();
$router = new ApiRouter(new ResponseFactory());

$router->add('GET', '/hello', [HelloController::class, 'world']);

$emitter = new Emitter();

new App($serverRequestFactory, $router, $emitter);
