<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BrokeMailSent implements ShouldBeStored
{


    /** @var int */
    public $accountUuid;

    public function __construct(string $accountUuid)
    {
        $this->accountUuid = $accountUuid;
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
