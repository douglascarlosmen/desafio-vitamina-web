<?php

namespace Modules\Sellers\Services;

use Illuminate\Support\Collection;
use Modules\Sellers\Contracts\Repositories\SellerRepositoryInterface;
use Modules\Sellers\Contracts\Services\SellerServiceInterface;
use Modules\Sellers\Entities\Seller;

class SellerService implements SellerServiceInterface
{
    private $repository;

    public function __construct(SellerRepositoryInterface $sellerRepository)
    {
        $this->repository = $sellerRepository;
    }

    public function getAllSellers(): Collection
    {
        return $this->repository->getAll();
    }

    public function getSellerIdToLinkToSaleOpportunity(string $sellerName): int
    {
        $sellerByName = $this->getSellerByName($sellerName);
        $seller = $sellerByName ? $sellerByName : $this->storeNewSeller(['name' => $sellerName]);

        return $seller->id;
    }

    public function getSellerByName(string $name): Seller|null
    {
        return $this->repository->getSellerByColumnsValues(['name' => $name]);
    }

    public function storeNewSeller(array $newSellerData): Seller
    {
        return $this->repository->store($newSellerData);
    }
}
