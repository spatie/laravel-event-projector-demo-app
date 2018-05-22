<?php

namespace App\Events;

use App\Account;
use Spatie\EventProjector\ShouldBeStored;
use Spatie\EventProjector\StoresEvent;

class AccountCreated implements ShouldBeStored
{
    use StoresEvent;

    /** @var \App\Account */
    public $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }
}
