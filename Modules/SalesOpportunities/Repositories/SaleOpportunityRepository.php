<?php

namespace Modules\SalesOpportunities\Repositories;

use Illuminate\Support\Collection;
use Modules\SalesOpportunities\Contracts\Repositories\SaleOpportunityRepositoryInterface;
use Modules\SalesOpportunities\Entities\SaleOpportunity;

class SaleOpportunityRepository implements SaleOpportunityRepositoryInterface
{
    private $model;

    public function __construct(SaleOpportunity $saleOpportunity)
    {
        $this->model = $saleOpportunity;
    }

    public function store(array $data): SaleOpportunity
    {
        return $this->model->create($data);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
