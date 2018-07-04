<?php

namespace App\Projectors;

use App\Account;
use App\Events\AccountClosed;
use App\Events\AccountCreated;
use App\Events\BrokeMailSent;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class AccountBalanceProjector implements Projector
{
    use ProjectsEvents;

    /*
     * Here you can specify which event should trigger which method
     */
    public $handlesEvents = [
        AccountCreated::class => 'onAccountCreated',
        MoneyAdded::class => 'onMoneyAdded',
        MoneySubtracted::class => 'onMoneySubtracted',
        AccountClosed::class => 'onAccountDeleted',
        BrokeMailSent::class => 'onBrokeMailSent'
    ];

    public function onAccountCreated(AccountCreated $event)
    {
        Account::create($event->accountAttributes);
    }

    public function onMoneyAdded(MoneyAdded $event)
    {
        $account = Account::uuid($event->accountUuid);

        $account->balance += $event->amount;

        if ($account->balance >= 0) {
            $this->broke_mail_sent = false;
        }

        $account->save();
    }

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $account = Account::uuid($event->accountUuid);

        $account->balance -= $event->amount;

        $account->save();
    }

    public function onBrokeMailSent(BrokeMailSent $event)
    {
        $account = Account::uuid($event->accountUuid);

        $account->broke_mail_sent = true;

        $account->save();
    }

    public function onAccountDeleted(AccountClosed $event)
    {
        Account::uuid($event->accountUuid)->delete();
    }

    public function resetState()
    {
        Account::truncate();
    }

    public function streamEventsBy(): string
    {
        return 'accountUuid';
    }
}
