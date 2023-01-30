<?php
namespace Helpers;

interface IConnector
{
    public function openConnection():void;
    public function closeConnection():void;
    public function save($data):void;
}
