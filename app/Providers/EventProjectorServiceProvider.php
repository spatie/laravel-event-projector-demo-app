<?php

namespace App\Providers;

use App\Projectors\AccountBalanceProjector;
use App\Projectors\TransactionCountProjector;
use App\Reactors\BigAmountAddedReactor;
use App\Reactors\BrokeReactor;
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

        EventProjectionist::addReactors([
            BigAmountAddedReactor::class,
            BrokeReactor::class,
        ]);
    }
}
