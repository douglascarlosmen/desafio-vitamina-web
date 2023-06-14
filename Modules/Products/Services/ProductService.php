<?php

namespace Modules\Products\Services;

use Illuminate\Support\Collection;
use Modules\Products\Contracts\Services\ProductServiceInterface;
use Modules\Products\Contracts\Repositories\ProductRepositoryInterface;
use Modules\Products\Entities\Product;

class ProductService implements ProductServiceInterface
{
    private $repository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function getAllProducts(): Collection
    {
        return $this->repository->getAll();
    }

    public function getProductIdToLinkToSaleOpportunity(string $productName): int
    {
        $productByName = $this->getProductByName($productName);
        $product = $productByName ? $productByName : $this->storeNewProduct(['name' => $productName]);

        return $product->id;
    }

    public function getProductByName(string $name): Product|null
    {
        return $this->repository->getProductByColumnsValues(['name' => $name]);
    }

    public function storeNewProduct(array $newProductData): Product
    {
        return $this->repository->store($newProductData);
    }
}
