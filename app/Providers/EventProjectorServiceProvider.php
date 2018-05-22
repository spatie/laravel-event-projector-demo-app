<?php

namespace App\Providers;

use App\Projectors\AccountBalanceProjector;
use App\Projectors\TransactionCountProjector;
use Illuminate\Support\ServiceProvider;
use Spatie\EventProjector\Facades\EventProjectionist;

class EventProjectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        EventProjectionist::addProjectors([
            AccountBalanceProjector::class,
            TransactionCountProjector::class,
        ]);
    }
}
