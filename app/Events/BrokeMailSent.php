<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BrokeMailSent implements ShouldBeStored
{
    /** @var int */
    public $accountId;

    public function __construct(int $accountId)
    {
        $this->accountId = $accountId;
    }
}
