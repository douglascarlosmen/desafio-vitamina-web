<?php

namespace Modules\SalesOpportunities\Services;

use Illuminate\Support\Collection;
use Modules\SalesOpportunities\Contracts\Repositories\SaleOpportunityRepositoryInterface;
use Modules\SalesOpportunities\Contracts\Services\SaleOpportunityServiceInterface;
use Modules\SalesOpportunities\Entities\SaleOpportunity;

class SaleOpportunityService implements SaleOpportunityServiceInterface
{
    private $repository;

    public function __construct(SaleOpportunityRepositoryInterface $saleOpportunityRepository)
    {
        $this->repository = $saleOpportunityRepository;
    }

    public function saveNewSaleOpportunity(array $saleOpportunityData): SaleOpportunity
    {
        return $this->repository->store($saleOpportunityData);
    }

    public function getAllSalesOpportunities(): Collection
    {
        return $this->repository->getAll();
    }
}
