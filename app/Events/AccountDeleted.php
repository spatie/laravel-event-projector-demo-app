<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;
use Spatie\EventProjector\StoresEvent;

class AccountDeleted implements ShouldBeStored
{
    use StoresEvent;

    /** @var int */
    public $accountId;

    public function __construct(int $accountId)
    {
        $this->accountId = $accountId;
    }
}
