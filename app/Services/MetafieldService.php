<?php

namespace App\Services;

use App\Services\Service;
use Osiset\ShopifyApp\Contracts\ShopModel;

class MetafieldService extends Service
{


    public function getMetafields($shop, $resource, $resourceId)
    {
        $metafields = $this->shopify->metafield->get($resource, $resourceId);
        return $metafields;
    }

    public function createMetafield($shop, $resource, $resourceId, $data)
    {
        $metafield = $this->shopify->metafield->create($resource, $resourceId, $data);
        return $metafield;
    }

    public function updateMetafield(ShopModel $shop, array $metafields)
    {
        $shop->api()->graph(view('graphql.update-metafield')->render(), [
            'metafields' => $metafields
        ]);
    }

    public function deleteMetafield($shop, $resource, $resourceId, $metafieldId)
    {
        $metafield = $this->shopify->metafield->delete($resource, $resourceId, $metafieldId);
        return $metafield;
    }

}
