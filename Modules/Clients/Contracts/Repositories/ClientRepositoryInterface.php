<?php

namespace Modules\Clients\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Clients\Entities\Client;

interface ClientRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param array $columnsAndValues
     * @return Client|null
     */
    public function getClientByColumnsValues(array $columnsAndValues): Client|null;

    /**
     * @param array $data
     * @return Client
     */
    public function store(array $data): Client;
}
