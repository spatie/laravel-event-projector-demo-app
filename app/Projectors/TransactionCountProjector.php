<?php

namespace App\Projectors;

use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\TransactionCount;

class TransactionCountProjector
{
    public $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
        MoneySubtracted::class => 'onMoneySubtracted',
    ];

    public function onMoneyAdded(MoneyAdded $event)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_id' => $event->accountId]);

        $transactionCounter->count +=1;

        $transactionCounter->save();
    }

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_id' => $event->accountId]);

        $transactionCounter->count -=1;

        $transactionCounter->save();
    }

    public function onStartingEventReplay()
    {
        TransactionCount::truncate();
    }
}