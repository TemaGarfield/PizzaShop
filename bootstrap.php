<?php

use App\controller\ConverterController;
use App\controller\MainController;
use App\controller\OrderController;
use App\controller\PizzaController;
use App\controller\SauceController;
use App\controller\SizeController;
use DI\ContainerBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

function getConnectionParams():array {
    return [
        'dbname' => 'amasty',
        'user' => 'tema',
        'password' => 'password',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
}

function getConfig(): Configuration
{
    return ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__."/src"),
        isDevMode: true,
    );
}

function getConnection() {
    return DriverManager::getConnection(getConnectionParams(), getConfig());
}

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    EntityManager::class => function () {
        return new EntityManager(getConnection(), getConfig());
    },

    QueryBuilder::class => function () {
        return new QueryBuilder(getConnection());
    }
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/pizza-shop/', [MainController::class, 'index']);
    $r->addRoute('GET', '/pizza-shop/getAllSauces', [SauceController::class, 'getAll']);
    $r->addRoute('GET', '/pizza-shop/getAllSizes', [SizeController::class, 'getAllSizes']);
    $r->addRoute('GET', '/pizza-shop/getAllPizzas', [PizzaController::class, 'getAll']);
    $r->addRoute('POST', '/pizza-shop/order', [OrderController::class, 'order']);
    $r->addRoute('POST', '/pizza-shop/convert', [ConverterController::class, 'convert']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump('404');
        die();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump('405');
        die();
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // ... call $handler with $vars
        $container->call($handler, $vars);
        break;
}

