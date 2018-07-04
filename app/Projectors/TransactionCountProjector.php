<?php

namespace App\Projectors;

use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\TransactionCount;
use Spatie\EventProjector\Models\StoredEvent;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class TransactionCountProjector implements Projector
{
    use ProjectsEvents;

    public $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
        MoneySubtracted::class => 'onMoneySubtracted',
    ];

    public function onMoneyAdded(MoneyAdded $event)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_uuid' => $event->accountUuid]);

        $transactionCounter->count += 1;

        $transactionCounter->save();
    }

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_uuid' => $event->accountUuid]);

        $transactionCounter->count += 1;

        $transactionCounter->save();
    }

    public function onStartingEventReplay()
    {
        TransactionCount::truncate();
    }

    public function resetState()
    {
        TransactionCount::truncate();
    }

    public function streamEventsBy(StoredEvent $storedEvent): array
    {
        return [
            'accountUuid' => $storedEvent->event->accountUuid,
        ];
    }
}
