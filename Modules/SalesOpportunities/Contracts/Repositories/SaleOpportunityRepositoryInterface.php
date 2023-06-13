<?php

namespace Modules\SalesOpportunities\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\SalesOpportunities\Entities\SaleOpportunity;

interface SaleOpportunityRepositoryInterface
{
    /**
     * @param array $data
     * @return SaleOpportunity
     */
    public function store(array $data): SaleOpportunity;

    /**
     * @return Collection
     */
    public function getAll(): Collection;
}
