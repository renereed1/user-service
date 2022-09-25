<?php declare(strict_types=1);

namespace Renereed1\UserService\Domain\User;

use DateTimeInterface;

interface Clock
{
    public function now(): DateTimeInterface;
}