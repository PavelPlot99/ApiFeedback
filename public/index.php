<?php

use Slim\Factory\AppFactory;
use App\Services\Form\File\FileSaver;
use App\Services\Form\Database\DbSaver;
use DI\Container;
use App\Controllers\FeedbackController;

require __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../common/env.php');

$container = new Container();

$container->set('formSaver', function () {
    return new FileSaver();
    //return new DbSaver(); если нужно сохранить в БД

});
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->addBodyParsingMiddleware();

$app->post('/', FeedbackController::class);

$app->run();
