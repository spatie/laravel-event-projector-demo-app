<?php

namespace App\Projectors;

use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;

class BalanceProjector
{
    public $handlesEvents = [
        AccountCreated::class => 'onAccountCreated',
        MoneyAdded::class => 'onMoneyAdded',
        MoneySubtracted::class => 'onMoneySubtracted',
        AccountDeleted::class => 'onAccountDeleted',
    ];

    public function onAccountCreated(AccountCreated $event)
    {

    }

    public function onMoneyAdded(MoneyAdded $moneyAdded)
    {

    }

    public function onMoneySubstracted(MoneySubtracted $moneyAdded)
    {

    }

    public function onAccountDeleted(AccountDeleted $event)
    {

    }


}