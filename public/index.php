<?php

use Slim\Factory\AppFactory;
use App\Services\Form\File\FileSaver;
use DI\Container;
use App\Controllers\FeedbackController;

require __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../common/env.php');

$container = new Container();

$container->set('formSaver', function () {
    return new FileSaver();
});
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->post('/', FeedbackController::class);

$app->run();
