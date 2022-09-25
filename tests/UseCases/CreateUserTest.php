<?php declare(strict_types=1);

namespace Renereed1\UserServiceTest\UseCases;

use PHPUnit\Framework\TestCase;

use Renereed1\UserService\UseCases\CreateUser\CreateUser;
use Renereed1\UserService\UseCases\CreateUser\CreateUserRequest;
use Renereed1\UserService\UseCases\CreateUser\CreateUserResponse;


class CreateUserTest extends TestCase
{
    /**
     * @covers Renereed1\UserService\UseCases\CreateUser\CreateUser
     *
     * @return void
     */
    public function testCreateUserUseCase(): void
    {
        $request = new CreateUserRequest();
        $useCase = new CreateUser();

        $response = $useCase->execute($request);

        $this->assertInstanceOf(CreateUserResponse::class, $response);
    }
}
