<?php

namespace App\Listeners;

use App\Events\ShopCreate;
use App\Helpers\Shopify\Shopify;
use App\Models\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ProductsSave
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
     * @param  ShopCreate  $event
     * @return void
     */
    public function handle(ShopCreate $event)
    {
        $shop = $event->shop;

        $shopify = Shopify::getInstance(
            $shop->myshopify_domain,
            $shop->token
        );

        $pages = floor($shopify->getCount('products') / 250)+1;

        $pages = $pages >= 20 ? 20 : $pages;

        for ($i = 1; $i <= $pages; $i++) {

            $products = $shopify->get('products',
                ['limit' => 250]
            )->toArray();

            $shop->products()->createMany($products);

        }
    }
}
