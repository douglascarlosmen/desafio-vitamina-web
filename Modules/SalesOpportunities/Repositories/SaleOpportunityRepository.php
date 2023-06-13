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

    public function update(int $id, array $data): void
    {
        $saleOpportunity = $this->getById($id);
        $saleOpportunity->update($data);
    }

    public function getById(int $id): SaleOpportunity
    {
        return $this->model->find($id);
    }
}
