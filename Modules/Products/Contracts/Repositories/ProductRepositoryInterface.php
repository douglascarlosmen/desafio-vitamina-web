<?php

namespace Modules\Products\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Products\Entities\Product;

interface ProductRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param array $columnsAndValues
     * @return Product|null
     */
    public function getProductByColumnsValues(array $columnsAndValues): Product|null;

    /**
     * @param array $data
     * @return Product
     */
    public function store(array $data): Product;
}
