<?php

namespace App\Factory;

use App\DataTransferObjects\FeedbackData;

abstract class PreserverAppeal
{
    abstract public function getPreserver();

    /*
     * @param FeedbackData $data
     */
    public function save(FeedbackData $data): void
    {
        $saver = $this->getPreserver();
        $saver->openConnection();
        $saver->save($data);
        $saver->closeConnection();
    }
}
