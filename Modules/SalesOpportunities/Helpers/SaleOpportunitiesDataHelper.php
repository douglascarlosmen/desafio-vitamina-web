<?php

namespace Modules\SalesOpportunities\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Modules\Products\Contracts\Services\ProductServiceInterface;
use Modules\Clients\Contracts\Services\ClientServiceInterface;
use Modules\Sellers\Contracts\Services\SellerServiceInterface;

class SaleOpportunitiesDataHelper
{
    private $clientService;
    private $productService;
    private $sellerService;

    public function __construct(
        ClientServiceInterface $clientService,
        ProductServiceInterface $productService,
        SellerServiceInterface $sellerService
    )
    {
        $this->clientService = $clientService;
        $this->productService = $productService;
        $this->sellerService = $sellerService;
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

    public function buildSellersObjectToAutocomplete(): string
    {
        $sellers = $this->sellerService->getAllSellers();

        $sellers->transform(function ($seller) {
            return $seller->name;
        })->toJson();

        return addslashes($sellers);
    }

    public function sellersObjectToSelectFilter(): Collection
    {
        return $this->sellerService->getAllSellers();
    }
}
