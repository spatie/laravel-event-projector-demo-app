<?php

namespace App\Reactors;

use App\Events\MoneyAdded;
use App\Mail\BigAmountAddedMail;
use Illuminate\Support\Facades\Mail;

class BigAmountAddedReactor
{
    public $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
    ];

    public function onBigAmountAdded(MoneyAdded $event)
    {
        if ($event->amount < 10000) {
            return;
        }

        $account = Account::find($event->accountId);

        Mail::to('director@bank.com')->send(new BigAmountAddedMail($account, $event->amount));
    }
}