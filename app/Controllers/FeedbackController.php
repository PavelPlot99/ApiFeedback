<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rakit\Validation\Validator;
use App\DataTransferObjects\FeedbackData;

class FeedbackController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args):ResponseInterface
    {
        $validator = new Validator();

        $data = FeedbackData::fromRequest($request);

        $vadation = $validator->make($data->toArray(), [
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

        $saver = $this->container->get('formSaver');
        $saver->save($data);
        $response->getBody()->write(json_encode(["message" => "data saved"]));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
