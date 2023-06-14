<?php

namespace Modules\Sellers\Repositories;

use Illuminate\Support\Collection;
use Modules\Sellers\Contracts\Repositories\SellerRepositoryInterface;
use Modules\Sellers\Entities\Seller;

class SellerRepository implements SellerRepositoryInterface
{
    private $model;

    public function __construct(Seller $seller)
    {
        $this->model = $seller;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getSellerByColumnsValues(array $columnsAndValues): Seller|null
    {
        return $this->model->where($columnsAndValues)->first();
    }

    public function store(array $data): Seller
    {
        return $this->model->create($data);
    }
}
