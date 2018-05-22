<?php

namespace App;

use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public static function boot()
    {
        static::created(function (Account $account) {
            event(new AccountCreated($account));
        });

        static::deleted(function (Account $account) {
            event(new AccountDeleted($account->id));
        });
    }

    public function addMoney(int $amount)
    {
        event(new MoneyAdded($this, $amount));
    }

    public function subtractMoney(int $amount)
    {
        event(new MoneySubtracted($this, $amount));
    }
}
