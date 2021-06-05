<?php

namespace App\Service;

use App\Enum\EventEnum;

class EventService
{
    public function getEventsNamePriceMap() : array
    {
        return [
            EventEnum::EVENT_APPOINTMENT => 3.99,
            EventEnum::EVENT_ACTIVATION => .99,
            EventEnum::EVENT_REGISTRATION => .49,
        ];
    }
}