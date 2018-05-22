<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class MoneyAdded implements ShouldBeStored
{
    /** @var int */
    public $accountId;

    /** @var int */
    public $amount;

    public function __construct(int $accountId, int $amount)
    {
        $this->accountId = $accountId;

        $this->amount = $amount;
    }
}
