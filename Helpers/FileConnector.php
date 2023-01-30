<?php
namespace Helpers;
use Helpers\IConnector;

class FileConnector implements IConnector

{
    private string $filepath = __DIR__.'\..\Storage\storage.txt';
    public $file;
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
        fwrite($this->file, "name = ".$data["name"]."\n". "phone = ".$data['phone']."\n". 'text = '.$data['text']."\n");
        fwrite($this->file, "----------------------------------------\n" );
    }
}
