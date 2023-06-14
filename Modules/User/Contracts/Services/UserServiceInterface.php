<?php

namespace Modules\User\Contracts\Services;

use Modules\User\Entities\User;

interface UserServiceInterface
{
    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): User|null;
}
