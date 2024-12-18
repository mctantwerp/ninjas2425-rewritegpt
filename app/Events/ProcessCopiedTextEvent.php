<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Facades\Log;

class ProcessCopiedTextEvent implements ShouldBroadcastNow
{

    public function broadcastOn(): array
    {

        return [
            new Channel('nativephp'),
        ];
    }

}