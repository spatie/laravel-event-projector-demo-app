<?php

namespace App\Events;

use App\Account;
use Spatie\EventProjector\ShouldBeStored;
use Spatie\EventProjector\StoresEvent;

class MoneyAdded implements ShouldBeStored
{
    use StoresEvent;

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
