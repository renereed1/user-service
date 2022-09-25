<?php declare(strict_types=1);

namespace Renereed1\UserService\UseCases\CreateUser;

class CreateUserResponse
{

    public readonly string $userId;
    public readonly string $createdAt;

    public function __construct(string $userId, string $createdAt)
    {
        $this->userId = $userId;
        $this->createdAt = $createdAt;
    }
}