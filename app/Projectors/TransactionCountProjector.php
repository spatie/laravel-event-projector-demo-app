<?php

namespace App\Projectors;

use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\TransactionCount;
use Spatie\EventProjector\Models\StoredEvent;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;
use Spatie\EventProjector\Snapshots\CanTakeSnapshot;
use Spatie\EventProjector\Snapshots\Snapshot;
use Spatie\EventProjector\Snapshots\Snapshottable;

class TransactionCountProjector implements Projector, Snapshottable
{
    use ProjectsEvents, CanTakeSnapshot;

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

    public function writeToSnapshot(Snapshot $snapshot)
    {
        $serializableModels = TransactionCount::get()
            ->map(function (TransactionCount $transactionCount) {
                return $transactionCount->toArray();
            })
            ->toArray();

        $serializedModels = serialize($serializableModels);

        $snapshot->write($serializedModels);
    }

    public function restoreFromSnapshot(Snapshot $snapshot)
    {
        $serializedModels = unserialize($snapshot->read(), true);

        foreach ($serializedModels as $modelAttributes) {
            TransactionCount::create($modelAttributes);
        }
    }

    public function resetState()
    {
        TransactionCount::truncate();
    }

    public function groupProjectorStatusBy(StoredEvent $storedEvent): array
    {
        return [
            'accountUuid' => $storedEvent->event->accountUuid,
        ];
    }
}
