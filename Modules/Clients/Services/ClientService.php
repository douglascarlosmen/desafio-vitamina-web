<?php

namespace Modules\Clients\Services;

use Illuminate\Support\Collection;
use Modules\Clients\Contracts\Repositories\ClientRepositoryInterface;
use Modules\Clients\Contracts\Services\ClientServiceInterface;
use Modules\Clients\Entities\Client;
use Modules\Clients\Repositories\ClientSaleOpportunityRepository;

class ClientService implements ClientServiceInterface
{
    private $repository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->repository = $clientRepository;
    }

    public function getAllClients(): Collection
    {
        return $this->repository->getAll();
    }

    public function getClientIdToLinkToSaleOpportunity(string $clientName): int
    {
        $clientByName = $this->getClientByName($clientName);
        $client = $clientByName ? $clientByName : $this->storeNewClient(['name' => $clientName]);

        return $client->id;
    }

    public function getClientByName(string $name): Client|null
    {
        return $this->repository->getClientByColumnsValues(['name' => $name]);
    }

    public function storeNewClient(array $newClientData): Client
    {
        return $this->repository->store($newClientData);
    }
}
