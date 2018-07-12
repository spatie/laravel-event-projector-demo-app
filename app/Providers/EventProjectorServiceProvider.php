<?php

namespace App\Providers;

use App\Projectors\AccountBalanceProjector;
use App\Projectors\TransactionCountProjector;
use App\Projectors\UnrelatedProjector;
use App\Reactors\BigAmountAddedReactor;
use App\Reactors\BrokeReactor;
use Illuminate\Support\ServiceProvider;
use Spatie\EventProjector\Facades\Projectionist;

class EventProjectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        Projectionist::addProjectors([
            AccountBalanceProjector::class,
            TransactionCountProjector::class,
            UnrelatedProjector::class,
        ]);


        Projectionist::addReactors([
            BigAmountAddedReactor::class,
            BrokeReactor::class,
        ]);
    }
}
