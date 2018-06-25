<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BrokeMailSent implements ShouldBeStored
{
    /** @var string */
    public $accountUuid;

    public function __construct(string $accountUuid)
    {
        $this->accountUuid = $accountUuid;
    }
}
