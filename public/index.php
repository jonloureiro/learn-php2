<?php ini_set("display_errors", 1);

use MinhasHoras\App;
use MinhasHoras\Http\Emitter;
use MinhasHoras\Http\ResponseFactory;
use MinhasHoras\Http\ServerRequestFactory;
use MinhasHoras\Route\Router;
use MinhasHoras\Services\Hello\HelloController;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

$serverRequestFactory = new ServerRequestFactory();
$router = new Router(new ResponseFactory());

$router->api('GET', '/hello', [HelloController::class, 'world']);

$emitter = new Emitter();

new App($serverRequestFactory, $router, $emitter);
