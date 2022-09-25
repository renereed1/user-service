<?php declare(strict_types=1);

namespace Renereed1\UserService\UseCases\CreateUser;

class CreateUserRequest
{
    public readonly string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}