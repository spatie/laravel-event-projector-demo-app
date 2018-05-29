<?php

namespace App\Projectors;

use App\Account;
use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
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
        AccountDeleted::class => 'onAccountDeleted',

        // broke mail sent event => onBrokenMailSent
    ];

    public function onAccountCreated(AccountCreated $event)
    {
        Account::create($event->accountAttributes);
    }

    public function onMoneyAdded(MoneyAdded $event)
    {
        $account = Account::find($event->accountId);

        $account->balance += $event->amount;

        $account->save();
    }

    public function onMoneySubtracted(MoneyAdded $event)
    {
        $account = Account::find($event->accountId);

        $account->balance += $event->amount;

        if ($account->balance >= 0 ) {
            $this->broke_mail_sent = false;
        }

        $account->save();
    }

    public function onAccountDeleted(AccountDeleted $event)
    {
        Account::find($event->accountId)->delete();
    }

    public function onStartingEventReplay()
    {
        Account::truncate();
    }
}