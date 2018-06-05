<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class AccountCreated implements ShouldBeStored
{
    /** array */
    public $accountAttributes;

    public function __construct(array $accountAttributes)
    {
        $this->accountAttributes = $accountAttributes;
    }
}
