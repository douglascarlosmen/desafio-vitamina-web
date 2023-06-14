<?php

namespace Modules\Clients\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\Clients\Entities\Client;

interface ClientServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllClients(): Collection;

    /**
     * @param string $clientName
     * @return integer
     */
    public function getClientIdToLinkToSaleOpportunity(string $clientName): int;

    /**
     * @param string $name
     * @return Client|null
     */
    public function getClientByName(string $name): Client|null;

    /**
     * @param array $newClientData
     * @return Client
     */
    public function storeNewClient(array $newClientData): Client;
}
