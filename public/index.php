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
use MinhasHoras\Route\Strategy\ApplicationStrategy;
use MinhasHoras\Route\Strategy\JsonStrategy;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

$isGet = strtolower($_SERVER['REQUEST_METHOD']) === 'get';
$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';

if ($isApi) {
    $responseFactory = new ResponseFactory();
    $strategy = new JsonStrategy($responseFactory);
    $router = new ApiRouter($responseFactory, $strategy);
    $router->add('GET', '/hello', [HelloController::class, 'world']);
    common($router);
} elseif ($isGet) {
    $responseFactory = new ResponseFactory();
    $strategy = new ApplicationStrategy($responseFactory);
    $router = new ClientRouter($responseFactory, $strategy);
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
