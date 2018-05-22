<?php

namespace App\Events;

use App\Account;
use Spatie\EventProjector\ShouldBeStored;
use Spatie\EventProjector\StoresEvent;

class AccountCreated implements ShouldBeStored
{
    use StoresEvent;

    /** array */
    public $accountAttributes;

    public function __construct(array $accountAttributes)
    {
        $this->accountAttributes = $accountAttributes;
    }
}
