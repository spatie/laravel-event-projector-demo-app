<?php

namespace App\Providers;

use App\Projectors\TransactionCountProjector;
use Illuminate\Support\ServiceProvider;
use Spatie\EventProjector\Facades\EventProjectionist;

class EventProjectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        EventProjectionist::addProjector(TransactionCountProjector::class);
    }
}
