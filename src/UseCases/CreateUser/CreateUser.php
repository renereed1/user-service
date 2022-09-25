<?php declare(strict_types=1);

namespace Renereed1\UserService\UseCases\CreateUser;

use Renereed1\UserService\Domain\User\UserExists;
use Renereed1\UserService\Domain\User\UserRepository;

class CreateUser
{
    const USER_EXISTS_EXCEPTION_MESSAGE = 'User exists';

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        if ($this->userRepository->userExistsWithEmail($request->email))
            throw new UserExists(self::USER_EXISTS_EXCEPTION_MESSAGE);

        $userId = $this->userRepository->nextIdentity();

        return new CreateUserResponse($userId->userId);
    }
}