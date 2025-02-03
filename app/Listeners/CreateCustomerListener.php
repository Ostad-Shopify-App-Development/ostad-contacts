<?php

namespace App\Listeners;

use App\Events\FormSubmittedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Osiset\ShopifyApp\Contracts\ShopModel;
use Osiset\ShopifyApp\Messaging\Events\AppInstalledEvent;

class CreateCustomerListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FormSubmittedEvent $event): void
    {
        $shop = User::find($event->formResponse->user_id);
        $name = explode(' ', $event->formResponse->name);
        $firstName = $name[0];
        $lastName = $name[1] ?? '';

        $shop->api()->graph(view('graphql.create-customer')->render(),[
            'input' => [
                'email' => $event->formResponse->email,
                'firstName' => $firstName,
                'lastName' => $lastName,
            ],
        ]);

    }
}
