<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Osiset\ShopifyApp\Contracts\ShopModel;
use Osiset\ShopifyApp\Messaging\Events\AppInstalledEvent;

class ShopInfoSyncListener implements ShouldQueue
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
    public function handle(AppInstalledEvent $event): void
    {
        /**
         * @var ShopModel $shop
         */
        $shop = User::where('id', $event->shopId->toNative())->first();

        $response = $shop->api()->graph(view('graphql.shop-info')->render());
        $shopifyId = $response['body']['data']['shop']['id'];
        $email = $response['body']['data']['shop']['email'];

        $shop->shopify_id = $shopifyId;
        $shop->email = $email;

        $shop->save();


    }
}
