<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SubscriptionChangingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionChangingListener
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
     * @param  SubscriptionChangingEvent  $event
     * @return void
     */
    public function handle(SubscriptionChangingEvent $event)
    {
        if ($event->subscription->isDirty('status')){
           if($event->subscription->status == 'true') { //renewed
                $statusInfo = 'renewed';
           }
           else { //canceled
                $statusInfo = 'canceled';
           }

        }

        Http::retry(2, 100)->post(
            $event->subscription->third_party_url,
            [
                'event' => $statusInfo ,
                'appID' => $event->device->appId ,
                'deviceID' => $event->subscription->device_id ,
            ]
        );

    }
}
