<?php

namespace Modules\SalesOpportunities\Services;

use Illuminate\Support\Collection;
use Modules\Clients\Contracts\Services\ClientServiceInterface;
use Modules\SalesOpportunities\Contracts\Repositories\SaleOpportunityRepositoryInterface;
use Modules\SalesOpportunities\Contracts\Services\SaleOpportunityServiceInterface;

class SaleOpportunityService implements SaleOpportunityServiceInterface
{
    private $repository;
    private $clientService;

    public function __construct(
        SaleOpportunityRepositoryInterface $saleOpportunityRepository,
        ClientServiceInterface $clientService
    )
    {
        $this->repository = $saleOpportunityRepository;
        $this->clientService = $clientService;
    }

    public function saveNewSaleOpportunity(array $saleOpportunityData): void
    {
        $saleOpportunityData['client_id'] = $this->clientService->getClientIdToLinkToSaleOpportunity($saleOpportunityData['client']);
        unset($saleOpportunityData['client']);

        $this->repository->store($saleOpportunityData);
    }

    public function getAllSalesOpportunities(): Collection
    {
        return $this->repository->getAll();
    }

    public function changeSaleOpportunityStatus(int $saleOpportunityId, string $newStatus): void
    {
        $this->repository->update($saleOpportunityId, ['status' => $newStatus]);
    }
}
