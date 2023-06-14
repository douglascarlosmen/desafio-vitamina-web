<?php

namespace Modules\SalesOpportunities\Helpers;

use Modules\Clients\Contracts\Services\ClientServiceInterface;

class SaleOpportunitiesDataHelper
{
    private $clientService;

    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }

    public function buildClientsObjectToAutocomplete(): string
    {
        $clients = $this->clientService->getAllClients();

        $clients->transform(function ($client) {
            return $client->name;
        })->toJson();

        return addslashes($clients);
    }
}
