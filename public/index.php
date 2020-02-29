<?php ini_set("display_errors", 1);

use MinhasHoras\App;
use MinhasHoras\Http\Emitter;
use MinhasHoras\Http\ResponseFactory;
use MinhasHoras\Http\ServerRequestFactory;
use MinhasHoras\Route\ApiRouter;
use MinhasHoras\Api\Hello\HelloController;
use MinhasHoras\Route\RouterInterface;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

$isGet = strtolower($_SERVER['REQUEST_METHOD']) === 'get';
$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';

if ($isApi) {
    $router = new ApiRouter(new ResponseFactory());
    $router->add('GET', '/hello', [HelloController::class, 'world']);
    common($router);
} elseif ($isGet) {
} else {
}

function common(RouterInterface $router): void
{
    $serverRequestFactory = new ServerRequestFactory();
    $emitter = new Emitter();
    new App($serverRequestFactory, $router, $emitter);
}
