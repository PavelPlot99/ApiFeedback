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

        $validation = $validator->make($data->toArray(), [
            'name' => 'required',
            'text' => 'required|min:11',
            'phone' => 'required|numeric|min:11',
        ]);

        $validation->validate();
        if($validation->fails()){
            $messages = $validation->errors();
            $response->getBody()->write(json_encode($messages->toArray()));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(422);
        }

        $saver = $this->container->get('formSaver');
        $saver->save($data);
        $response->getBody()->write(json_encode(["message" => "data saved"]));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
