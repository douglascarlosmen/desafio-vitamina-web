<?php

namespace Modules\User\Contracts\Repositories;

use Modules\User\Entities\User;

interface UserRepositoryInterface
{
    /**
     * @param array $columnAndValues
     * @return User|null
     */
    public function getUserByColumnValues(array $columnAndValues): User|null;
}
