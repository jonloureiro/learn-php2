<?php ini_set("display_errors", 1);

use MinhasHoras\App;
use MinhasHoras\Api\Hello\HelloController;
use MinhasHoras\Client\Pages\LoginPage;
use MinhasHoras\Http\Emitter;
use MinhasHoras\Http\ResponseFactory;
use MinhasHoras\Http\ServerRequestFactory;
use MinhasHoras\Route\ApiRouter;
use MinhasHoras\Route\ClientRouter;
use MinhasHoras\Route\RouterInterface;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

$isGet = strtolower($_SERVER['REQUEST_METHOD']) === 'get';
$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';

if ($isApi) {
    $router = new ApiRouter(new ResponseFactory());
    $router->add('GET', '/hello', [HelloController::class, 'world']);
    common($router);
} elseif ($isGet) {
    $router = new ClientRouter(new ResponseFactory());
    $router->add('GET', '/login', LoginPage::class);
    common($router);
} else {
    echo "<h3>Algo de errado não está certo</h3>";
    die();
}

function common(RouterInterface $router): void
{
    $serverRequestFactory = new ServerRequestFactory();
    $emitter = new Emitter();
    new App($serverRequestFactory, $router, $emitter);
}
