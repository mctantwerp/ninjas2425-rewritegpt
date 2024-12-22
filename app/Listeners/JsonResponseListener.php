<?php

namespace App\Listeners;

use App\Events\JsonResponseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
 

class JsonResponseListener
{
    /**
     * Handle the event.
     */
    public function handle(JsonResponseEvent $event): void
    {
        $response = $event->response;
        
        $response = json_encode($response);
    }
}