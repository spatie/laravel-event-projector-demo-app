<?php

namespace App\Reactors;

use App\Account;
use App\Events\MoneyAdded;
use App\Mail\BigAmountAddedMail;
use Illuminate\Support\Facades\Mail;

class BigAmountAddedReactor
{
    public $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
    ];

    public function onMoneyAdded(MoneyAdded $event)
    {
        if ($event->amount < 900) {
            return;
        }

        $account = Account::find($event->accountId);

        Mail::to('director@bank.com')->send(new BigAmountAddedMail($account, $event->amount));
    }
}