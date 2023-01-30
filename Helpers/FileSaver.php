<?php
namespace Helpers;
use Factory\PreserverAppeal;
use Helpers\FileConnector;

class FileSaver extends PreserverAppeal
{

    public function getPreserver()
    {
        return new FileConnector();
    }
}
