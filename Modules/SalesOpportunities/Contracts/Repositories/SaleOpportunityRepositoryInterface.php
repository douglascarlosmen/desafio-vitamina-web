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
     * @param array $filters
     * @return Collection
     */
    public function getAll(array $filters): Collection;

    /**
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void;

    /**
     * @param integer $id
     * @return SaleOpportunity
     */
    public function getById(int $id): SaleOpportunity;
}
