<?php
namespace Factory;

abstract class PreserverAppeal
{
    abstract public function getPreserver();

    public function save($data): void
    {
        $saver = $this->getPreserver();
        $saver->openConnection();
        $saver->save($data);
        $saver->closeConnection();
    }
}
