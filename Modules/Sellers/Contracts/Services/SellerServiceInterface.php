<?php

namespace Modules\Sellers\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\Sellers\Entities\Seller;

interface SellerServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllSellers(): Collection;

    /**
     * @param string $sellerName
     * @return integer
     */
    public function getSellerIdToLinkToSaleOpportunity(string $sellerName): int;

    /**
     * @param string $name
     * @return Seller|null
     */
    public function getSellerByName(string $name): Seller|null;

    /**
     * @param array $newSellerData
     * @return Seller
     */
    public function storeNewSeller(array $newSellerData): Seller;
}
