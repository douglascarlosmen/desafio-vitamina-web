<?php

namespace Modules\User\Services;

use Modules\User\Contracts\Repositories\UserRepositoryInterface;
use Modules\User\Contracts\Services\UserServiceInterface;
use Modules\User\Entities\User;

class UserService implements UserServiceInterface
{
    private $repository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getUserByEmail(string $email): User|null
    {
        return $this->repository->getUserByColumnValues(['email' => $email]);
    }
}
