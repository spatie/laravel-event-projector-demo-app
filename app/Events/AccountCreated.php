<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;
use Spatie\EventProjector\StoresEvent;

class AccountCreated implements ShouldBeStored
{
    use StoresEvent;

    /** @var int */
    public  $accountId;

    /** @var string */
    public  $name;

    public function __construct(int $accountId, string $name)
    {
        $this->accountId = $accountId;

        $this->name = $name;
    }
}
