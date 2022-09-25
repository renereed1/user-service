<?php declare(strict_types=1);

namespace Renereed1\UserService\UseCases\CreateUser;

class CreateUser
{

    public function __construct()
    {
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        return new CreateUserResponse();
    }
}