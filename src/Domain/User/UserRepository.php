<?php declare(strict_types=1);

namespace Renereed1\UserService\Domain\User;

interface UserRepository
{
    public function userExistsWithEmail(string $email): bool;
}