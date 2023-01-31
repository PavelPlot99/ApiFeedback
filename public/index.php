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

$app->addBodyParsingMiddleware();

$app->post('/', FeedbackController::class);

$app->run();
