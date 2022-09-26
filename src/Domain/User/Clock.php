<?php declare(strict_types=1);

namespace Renereed1\UserService\Domain\User;

use DateTime;

interface Clock
{
    public function now(): DateTime;
}