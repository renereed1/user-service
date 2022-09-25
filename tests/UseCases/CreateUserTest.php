<?php declare(strict_types=1);

namespace Renereed1\UserServiceTest\UseCases;

use PHPUnit\Framework\TestCase;
use Mockery as m;

use Renereed1\UserService\Domain\User\UserExists;
use Renereed1\UserService\Domain\User\UserId;
use Renereed1\UserService\Domain\User\UserRepository;
use Renereed1\UserService\UseCases\CreateUser\CreateUser;
use Renereed1\UserService\UseCases\CreateUser\CreateUserRequest;
use Renereed1\UserService\UseCases\CreateUser\CreateUserResponse;


class CreateUserTest extends TestCase
{
    const NEW_USER_1_EMAIL = 'email@example.com';
    const NEW_USER_1_ID = 'USER_ID';

    const FUNCTION_USER_EXISTS_WITH_EMAIL = 'userExistsWithEmail';
    const FUNCTION_NEXT_IDENTITY = 'nextIdentity';

    private UserRepository $mockUserRepository;

    private CreateUser $useCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockUserRepository = m::mock(UserRepository::class);

        $this->useCase = new CreateUser($this->mockUserRepository);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        m::close();
    }

    /**
     * @covers Renereed1\UserService\UseCases\CreateUser\CreateUser
     *
     * @return void
     */
    public function testCreateUserUseCase(): void
    {
        $this->mockUserRepository->shouldReceive(self::FUNCTION_USER_EXISTS_WITH_EMAIL)
            ->with(self::NEW_USER_1_EMAIL)
            ->once()
            ->andReturn(false);

        $userId = new UserId(self::NEW_USER_1_ID);
        $this->mockUserRepository->shouldReceive(self::FUNCTION_NEXT_IDENTITY)
            ->once()
            ->andReturn($userId);

        $request = new CreateUserRequest(self::NEW_USER_1_EMAIL);

        $response = $this->useCase->execute($request);

        $this->assertInstanceOf(CreateUserResponse::class, $response);
    }

    /**
     * @covers Renereed1\UserService\UseCases\CreateUser\CreateUser
     *
     * @return void
     */
    public function testCreateUserWillThrowUserExistsExceptionWhenRegisteringANewUserWithAnExistingEmail(): void
    {
        $this->mockUserRepository->shouldReceive(self::FUNCTION_USER_EXISTS_WITH_EMAIL)
            ->with(self::NEW_USER_1_EMAIL)
            ->once()
            ->andReturn(true);

        $request = new CreateUserRequest(self::NEW_USER_1_EMAIL);

        $this->expectException(UserExists::class);
        $this->expectExceptionMessage(CreateUser::USER_EXISTS_EXCEPTION_MESSAGE);

        $this->useCase->execute($request);
    }

    /**
     * @covers Renereed1\UserService\UseCases\CreateUser\CreateUser
     *
     * @return void
     */
    public function testCreateUserDelegatesNewUserIdentityCreation(): void
    {
        $this->mockUserRepository->shouldReceive(self::FUNCTION_USER_EXISTS_WITH_EMAIL)
            ->with(self::NEW_USER_1_EMAIL)
            ->once()
            ->andReturn(false);

        $userId = new UserId(self::NEW_USER_1_ID);
        $this->mockUserRepository->shouldReceive(self::FUNCTION_NEXT_IDENTITY)
            ->once()
            ->andReturn($userId);

        $request = new CreateUserRequest(self::NEW_USER_1_EMAIL);

        $response = $this->useCase->execute($request);

        $this->assertEquals(self::NEW_USER_1_ID, $response->userId);
    }
}
