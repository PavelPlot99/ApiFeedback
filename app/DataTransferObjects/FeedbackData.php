<?php

namespace App\DataTransferObjects;

final class FeedbackData
{
    public string $name;
    public string $phone;
    public string $text;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->text = $data['text'];
        $this->phone = $data['phone'];
    }

    public static function fromRequest($request):self
    {
        $data = $request->getParsedBody();
        return new self([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'text' => $data['text'],
        ]);
    }

    public function toArray():array
    {
        return [
            'name' => $this->name,
            'text' => $this->text,
            'phone' => $this->phone
        ];
    }
}
