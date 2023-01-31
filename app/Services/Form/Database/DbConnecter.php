<?php

namespace App\Services\Form\Database;

use App\Services\Form\IConnector;

class DbConnecter implements IConnector
{
    public string $host;
    public string $db_name;
    public string $user;
    public string $password;
    public \PDO|null $connection;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function openConnection(): void
    {
        $this->connection = new \PDO(
            'mysql:host='.$this->host.';dbname='.$this->db_name,
            $this->user,
            $this->password,
        );
    }

    public function closeConnection(): void
    {
        $this->connection = null;
    }

    public function save($data): void
    {
        $result = $this->connection->prepare('INSERT INTO feedbacks (name, phone, text) VALUES (?, ?, ?)');
        $result->bindParam(1, $data->name);
        $result->bindParam(2, $data->phone);
        $result->bindParam(3, $data->text);
        $result->execute();
    }
}
