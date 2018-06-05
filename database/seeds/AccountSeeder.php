<?php

use App\Account;
use App\Events\AccountCreated;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $realNow = now();

        Carbon::setTestNow(now()->subMonths(2));

        while ($realNow->isFuture()) {

            if (faker()->boolean(80)) {
                Account::createWithAttributes([
                    'name' => faker()->name,
                    'email' => faker()->email,
                ]);
            }

            Account::get()->each(function (Account $account) {
                if (faker()->boolean(50)) {
                    $account->addMoney(faker()->numberBetween(1, 1000));
                }

                if (faker()->boolean(50)) {
                    $account->subtractMoney(faker()->numberBetween(1, 900));
                }

                if (faker()->boolean(1)) {
                    $account->close();
                }
            });

            $this->addRandomTime();
        }
    }

    protected function addRandomTime()
    {
        $now = now();

        $newNow = $now->addMinutes(faker()->numberBetween(45, 60 * 30));

        Carbon::setTestNow($newNow);
    }
}
