<?php

namespace Modules\Products\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\Products\Entities\Product;

interface ProductServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllProducts(): Collection;

    /**
     * @param string $productName
     * @return integer
     */
    public function getProductIdToLinkToSaleOpportunity(string $productName): int;

    /**
     * @param string $name
     * @return Product|null
     */
    public function getProductByName(string $name): Product|null;

    /**
     * @param array $newProductData
     * @return Product
     */
    public function storeNewProduct(array $newProductData): Product;
}
