<?php declare(strict_types=1);

namespace Renereed1\UserService\UseCases\CreateUser;

class CreateUserResponse
{

    public readonly string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }
}