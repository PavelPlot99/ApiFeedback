<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Helpers\FileSaver;
use Rakit\Validation\Validator;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->post('/add', function (Request $request, Response $response, $args) {
    $validator = new Validator();
    $data = $request->getParsedBody();
    $vadation = $validator->make($data, [
        'name' => 'required',
        'phone' => 'required|numeric|min:11',
        'text' => 'required|min:10',
    ]);

    $vadation->validate();
    if($vadation->fails()){
        $messages = $vadation->errors();
        $response->getBody()->write(json_encode($messages->toArray()));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(500);
    }

    $saver = new FileSaver();

    $saver->save($data);
    $response->getBody()->write(json_encode(["message" => "data saved"]));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run();
