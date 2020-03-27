<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Loader;
use Phalcon\Mvc\Micro;

$loader = new Loader();
$loader->registerNamespaces(
    [
        'Models' => '../app/models/',
    ]
);
$loader->register();

$container = new FactoryDefault();

$app = new Micro($container);

$app->get(
    '/',
    function () use ($app) {
        echo "holis";
    }
);

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, 'Not Found')->sendHeaders();
    echo '404 NOT FOUND!';
});

try {
    $app->handle(
        $_SERVER['REQUEST_URI']
    );
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
