<?php

namespace Emtudo\Domains\Courses\Events;

use Emtudo\Domains\Courses\Frequency;

class FrequencyCreating
{
    public function __construct(Frequency $frequency)
    {
        if ($frequency->present) {
            $frequency->justified_absence = false;
        }
    }
}
