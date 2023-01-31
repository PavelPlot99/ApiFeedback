<?php

namespace App\Services\Form\File;

use App\DataTransferObjects\FeedbackData;
use App\Services\Form\IConnector;

class FileConnector implements IConnector
{
    private string $filepath;
    public $file;

    public function __construct()
    {
        $this->filepath = $_ENV['FILE_LOCATION'];
    }

    public function openConnection(): void
    {
        $this->file = fopen($this->filepath, 'w');
    }

    public function closeConnection(): void
    {
       fclose($this->file);
    }

    public function save($data): void
    {
        fwrite($this->file,
            'name = '.$data->name.
            'phone = '.$data->phone.
            'text = '.$data->text);
    }
}
