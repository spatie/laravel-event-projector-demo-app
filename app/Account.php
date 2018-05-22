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
            event(new AccountCreated($account->getAttributes()));
        });

        static::deleted(function (Account $account) {
            event(new AccountDeleted($account->id));
        });
    }

    public function addMoney(int $amount)
    {
        $this->balance += $amount;
        $this->save();

        event(new MoneyAdded($this->id, $amount));
    }

    public function subtractMoney(int $amount)
    {
        $this->balance -= $amount;
        $this->save();

        event(new MoneySubtracted($this->id, $amount));
    }
}
