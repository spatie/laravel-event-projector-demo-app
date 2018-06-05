<?php

namespace App\Reactors;

use App\Events\MoneySubtracted;

class BrokeReactor
{
    public $handlesEvents = [
        MoneySubtracted::class => 'onMoneySubtracted',
    ];

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $account = Account::find($event->accountId);

        if ($account->isBroke() && ! $account->broke_mail_sent)
        {
            // send mail

            // send out broke event
        }
    }

}