<?php

namespace App;

use App\Events\AccountCreated;
use App\Events\AccountDeleted;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Account extends Model
{
    protected $guarded = [];

    protected $casts = [
        'broke_mail_send' => 'bool',
    ];

    public static function createWithAttributes(array $attributes): Account
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new AccountCreated($attributes));

        return static::uuid($attributes['uuid']);
    }

    public function addMoney(int $amount)
    {
        event(new MoneyAdded($this->uuid, $amount));
    }

    public function subtractMoney(int $amount)
    {
        event(new MoneySubtracted($this->uuid, $amount));
    }

    public function close()
    {
        event(new AccountDeleted($this->uuid));
    }

    public function isBroke(): bool
    {
        return $this->balance < 0;
    }

    public static function uuid(string $uuid): ?Account
    {
        return static::where('uuid', $uuid)->first();
    }
}
