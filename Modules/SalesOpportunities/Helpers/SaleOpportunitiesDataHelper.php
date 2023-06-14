<?php

namespace Modules\SalesOpportunities\Helpers;

use Modules\Products\Contracts\Services\ProductServiceInterface;
use Modules\Clients\Contracts\Services\ClientServiceInterface;

class SaleOpportunitiesDataHelper
{
    private $clientService;
    private $productService;

    public function __construct(
        ClientServiceInterface $clientService,
        ProductServiceInterface $productService
    )
    {
        $this->clientService = $clientService;
        $this->productService = $productService;
    }

    public function buildClientsObjectToAutocomplete(): string
    {
        $clients = $this->clientService->getAllClients();

        $clients->transform(function ($client) {
            return $client->name;
        })->toJson();

        return addslashes($clients);
    }

    public function buildProductsObjectToAutocomplete(): string
    {
        $products = $this->productService->getAllProducts();

        $products->transform(function ($product) {
            return $product->name;
        })->toJson();

        return addslashes($products);
    }
}
