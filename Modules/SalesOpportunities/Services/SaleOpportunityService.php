<?php

namespace Modules\SalesOpportunities\Services;

use Illuminate\Support\Collection;
use Modules\Products\Contracts\Services\ProductServiceInterface;
use Modules\Clients\Contracts\Services\ClientServiceInterface;
use Modules\SalesOpportunities\Contracts\Repositories\SaleOpportunityRepositoryInterface;
use Modules\SalesOpportunities\Contracts\Services\SaleOpportunityServiceInterface;
use Modules\Sellers\Contracts\Services\SellerServiceInterface;

class SaleOpportunityService implements SaleOpportunityServiceInterface
{
    private $repository;
    private $clientService;
    private $productService;
    private $sellerService;

    public function __construct(
        SaleOpportunityRepositoryInterface $saleOpportunityRepository,
        ClientServiceInterface $clientService,
        ProductServiceInterface $productService,
        SellerServiceInterface $sellerService
    )
    {
        $this->repository = $saleOpportunityRepository;
        $this->clientService = $clientService;
        $this->productService = $productService;
        $this->sellerService = $sellerService;
    }

    public function saveNewSaleOpportunity(array $saleOpportunityData): void
    {
        $saleOpportunityData['client_id'] = $this->clientService->getClientIdToLinkToSaleOpportunity($saleOpportunityData['client']);
        $saleOpportunityData['product_id'] = $this->productService->getProductIdToLinkToSaleOpportunity($saleOpportunityData['product']);
        $saleOpportunityData['seller_id'] = $this->sellerService->getSellerIdToLinkToSaleOpportunity($saleOpportunityData['seller']);

        unset($saleOpportunityData['client'], $saleOpportunityData['product'], $saleOpportunityData['seller']);

        $this->repository->store($saleOpportunityData);
    }

    public function getAllSalesOpportunities(array $filters): Collection
    {
        return $this->repository->getAll($filters);
    }

    public function changeSaleOpportunityStatus(int $saleOpportunityId, string $newStatus): void
    {
        $this->repository->update($saleOpportunityId, ['status' => $newStatus]);
    }
}
