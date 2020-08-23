<?php


namespace Test\Unit\Messenger\Domain\User;


use App\Messenger\Domain\User\UserLogin;
use PHPUnit\Framework\TestCase;

class UserLoginTest extends TestCase
{
    /** @test */
    public function that_we_can_create_login_with_valid_data(): void
    {
        $login = new UserLogin('Testowy Login');
        self::assertInstanceOf(UserLogin::class, $login);
    }

    /** @test */
    public function that_we_cannot_create_login_without_valid_data(): void
    {
        $this->expectException(\TypeError::class);
        new UserLogin(['test' => 'test']);
    }
}