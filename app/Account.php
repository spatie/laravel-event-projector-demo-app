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

    protected $casts = [
        'broke_mail_send' => 'bool',
    ];

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
        event(new MoneySubtracted($this->id, $amount));
    }

    public function close()
    {
        event(new AccountDeleted($this->id));
    }

    public function isBroke(): bool
    {
        return $this->balance < 0;
    }
}
