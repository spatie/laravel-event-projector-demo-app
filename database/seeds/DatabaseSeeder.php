<?php

use App\Account;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $realNow = now();

        Carbon::setTestNow(now()->subYear(2));

        if (faker()->boolean(80)) {
            (new Account(['name' => faker()->name]))->save();
        }

        Account::get()->each(function (Account $account) {
            if (faker()->boolean(50)) {
                $account->addMoney(faker()->numberBetween(1, 1000));
            }

            if (faker()->boolean(50)) {
                $account->addMoney(faker()->numberBetween(1, 500));
            }

            if (faker()->boolean(5)) {
                $account->delete();
            }
        });


        while ($realNow->isPast()) {
            $this->addRandomTime();
        }
    }

    protected function addRandomTime()
    {
        $now = now();

        $now->addMinutes(faker()->numberBetween(45, 60 * 30));
    }
}
