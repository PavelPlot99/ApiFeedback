<?php

namespace App\Services\Form;

interface IConnector
{
    public function openConnection():void;
    public function closeConnection():void;
    public function save($data):void;
}
