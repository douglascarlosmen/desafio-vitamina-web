<?php

namespace Modules\Clients\Repositories;

use Illuminate\Support\Collection;
use Modules\Clients\Contracts\Repositories\ClientRepositoryInterface;
use Modules\Clients\Entities\Client;

class ClientRepository implements ClientRepositoryInterface
{
    private $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getClientByColumnsValues(array $columnsAndValues): Client|null
    {
        return $this->model->where($columnsAndValues)->first();
    }

    public function store(array $data): Client
    {
        return $this->model->create($data);
    }
}
