<?php

namespace App\Services\Form\Database;

use App\Factory\PreserverAppeal;
use App\Services\Form\Database\DbConnecter;

class DbSaver extends PreserverAppeal
{
    public function getPreserver()
    {
        return new DbConnecter();
    }
}
