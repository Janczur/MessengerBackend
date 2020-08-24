<?php


namespace Test\Unit\Messenger\Domain\User;


use App\Messenger\Domain\User\UserEmail;
use App\Messenger\Domain\User\UserLogin;
use PHPUnit\Framework\TestCase;
use TypeError;

class UserEmailTest extends TestCase
{
    /** @test */
    public function that_we_can_create_email_with_valid_data(): void
    {
        $email = new UserEmail('test@test.pl');
        self::assertInstanceOf(UserEmail::class, $email);
    }

    /** @test */
    public function that_we_cannot_create_email_without_valid_data(): void
    {
        $this->expectException(TypeError::class);
        new UserEmail(new UserLogin('login'));
    }
}