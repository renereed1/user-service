<?php declare(strict_types=1);

namespace Renereed1\UserService\Domain\User;

use DateTime;

class User
{
    public readonly UserId $userId;
    public readonly DateTime $createdOn;
    private readonly string $email;

    public function __construct(UserId $userId, DateTime $createdOn, String $email)
    {
        $this->userId = $userId;
        $this->createdOn = $createdOn;
        $this->email = $email;
    }
}