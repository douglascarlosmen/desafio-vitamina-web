<?php

namespace Modules\User\Repositories;

use Modules\User\Contracts\Repositories\UserRepositoryInterface;
use Modules\User\Entities\User;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUserByColumnValues(array $columnAndValues): User|null
    {
        return $this->model->where($columnAndValues)->first();
    }
}
