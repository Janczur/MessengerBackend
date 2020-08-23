<?php


namespace Test\Unit\Messenger\Domain\User;


use App\Messenger\Domain\User\User;
use App\Messenger\Domain\User\UserContactChannels;
use App\Messenger\Domain\User\UserEmail;
use App\Messenger\Domain\User\UserLogin;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function that_you_can_create_user_with_valid_data(): void
    {
        $user = new User(
            new UserLogin('test'),
            new UserEmail('test@test.pl'),
            new UserContactChannels('email,sms')
        );

        self::assertInstanceOf(User::class, $user);
    }

    /** @test */
    public function that_you_cant_create_user_without_valid_data(): void
    {
        $this->expectException(\TypeError::class);
        new User(
            new UserLogin('test'),
            new UserEmail(['test@test.pl']),
            new UserContactChannels('test,sms')
        );
    }

}