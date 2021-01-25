<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SubscriptionCreatingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionCreatingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionCreatingEvent  $event
     * @return void
     */
    public function handle(SubscriptionCreatingEvent $event)
    {
        //started
        Http::retry(2, 100)->post(
            $event->subscription->third_party_url,
            [
                'event' => 'started',
                'appID' => $event->device->appId,
                'deviceID' => $event->subscription->device_id,
            ]
        );

    }
}
