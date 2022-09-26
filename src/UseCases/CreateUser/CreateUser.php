<?php declare(strict_types=1);

namespace Renereed1\UserService\UseCases\CreateUser;

use DateTimeInterface;
use Renereed1\UserService\Domain\User\Clock;
use Renereed1\UserService\Domain\User\User;
use Renereed1\UserService\Domain\User\UserExists;
use Renereed1\UserService\Domain\User\UserRepository;

class CreateUser
{
    const USER_EXISTS_EXCEPTION_MESSAGE = 'User exists';

    private UserRepository $userRepository;
    private Clock $clock;

    public function __construct(UserRepository $userRepository, Clock $clock)
    {
        $this->userRepository = $userRepository;
        $this->clock = $clock;
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        if ($this->userRepository->userExistsWithEmail($request->email))
            throw new UserExists(self::USER_EXISTS_EXCEPTION_MESSAGE);

        $user = $this->makeUser($request->email);

        $this->userRepository->add($user);

        return $this->makeCreateUserResponse($user);
    }

    private function makeUser(string $email): User
    {
        $userId = $this->userRepository->nextIdentity();
        $createdAt = $this->clock->now();

        return new User($userId, $createdAt, $email);
    }

    private function makeCreateUserResponse(User $user): CreateUserResponse
    {
        return new CreateUserResponse(
            $user->userId->userId,
            $user->createdOn->format(DateTimeInterface::ATOM));
    }
}