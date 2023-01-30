<?php

namespace App\Services\Form\File;

use App\Factory\PreserverAppeal;
use App\Services\Form\File\FileConnector;

class FileSaver extends PreserverAppeal
{
    public function getPreserver()
    {
        return new FileConnector();
    }
}
