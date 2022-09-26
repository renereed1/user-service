<?php declare(strict_types=1);

namespace Renereed1\UserService\Domain\User;

interface UserRepository
{
    public function userExistsWithEmail(string $email): bool;

    public function add(User $user): void;

    public function nextIdentity(): UserId;
}