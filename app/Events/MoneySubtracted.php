<?php

namespace App\Events;

use App\Account;
use Spatie\EventProjector\ShouldBeStored;
use Spatie\EventProjector\StoresEvent;

class MoneySubtracted implements ShouldBeStored
{
    use StoresEvent;

    /** @var \App\Account */
    public $account;

    /** @var int */
    public $amount;

    public function __construct(Account $account, int $amount)
    {
        $this->account = $account;

        $this->amount = $amount;
    }
}
