<?php declare(strict_types=1);

namespace Renereed1\UserService\Domain\User;

class UserId
{
    public readonly string $userId;

    /**
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }
}