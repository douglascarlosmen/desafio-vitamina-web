<?php

namespace Modules\Products\Repositories;

use Illuminate\Support\Collection;
use Modules\Products\Contracts\Repositories\ProductRepositoryInterface;
use Modules\Products\Entities\Product;

class ProductRepository implements ProductRepositoryInterface
{
    private $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getProductByColumnsValues(array $columnsAndValues): Product|null
    {
        return $this->model->where($columnsAndValues)->first();
    }

    public function store(array $data): Product
    {
        return $this->model->create($data);
    }
}
