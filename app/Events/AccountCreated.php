<?php

namespace App\Events;

class AccountCreated implements ShouldBeStored
{
    /** array */
    public $accountAttributes;

    public function __construct(array $accountAttributes)
    {
        $this->accountAttributes = $accountAttributes;
    }
}
