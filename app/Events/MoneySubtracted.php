<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class MoneySubtracted implements ShouldBeStored
{
    /** @var int */
    public $accountUuid;

    /** @var int */
    public $amount;

    public function __construct(string $accountUuid, int $amount)
    {
        $this->accountUuid = $accountUuid;

        $this->amount = $amount;
    }

    public function getStreamName()
    {
        return 'accounts';
    }

    public function getStreamId()
    {
        return $this->accountUuid;
    }
}
