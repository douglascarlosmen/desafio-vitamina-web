<?php

namespace Modules\SalesOpportunities\Contracts\Services;

use Illuminate\Support\Collection;

interface SaleOpportunityServiceInterface
{
    /**
     * @param array $saleOpportunityData
     * @return void
     */
    public function saveNewSaleOpportunity(array $saleOpportunityData): void;

    /**
     * @return Collection
     */
    public function getAllSalesOpportunities(): Collection;

    /**
     * @param string $newStatus
     * @return void
     */
    public function changeSaleOpportunityStatus(int $saleOpportunityId, string $newStatus): void;
}
