<?php

namespace Modules\SalesOpportunities\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\SalesOpportunities\Entities\SaleOpportunity;

interface SaleOpportunityServiceInterface
{
    /**
     * @param array $saleOpportunityData
     * @return SaleOpportunity
     */
    public function saveNewSaleOpportunity(array $saleOpportunityData): SaleOpportunity;

    /**
     * @return Collection
     */
    public function getAllSalesOpportunities(): Collection;
}
