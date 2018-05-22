<?php

namespace App;

use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    public static function createWithAttributes(array $attributes)
    {
        event(new AccountCreated($attributes));
    }

    public function addMoney(int $amount)
    {
        event(new MoneyAdded($this->id, $amount));
    }

    public function subtractMoney(int $amount)
    {
        $this->balance -= $amount;
        $this->save();

        event(new MoneySubtracted($this->id, $amount));
    }

    public function close()
    {
        event(new AccountDeleted($this->id));
    }
}
