<?php

namespace Modules\Sellers\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Sellers\Entities\Seller;

interface SellerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param array $columnsAndValues
     * @return Seller|null
     */
    public function getSellerByColumnsValues(array $columnsAndValues): Seller|null;

    /**
     * @param array $data
     * @return Seller
     */
    public function store(array $data): Seller;
}
