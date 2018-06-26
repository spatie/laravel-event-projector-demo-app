<?php

namespace App\Projectors;

use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

class UnrelatedProjector implements Projector
{
    use ProjectsEvents;
}
