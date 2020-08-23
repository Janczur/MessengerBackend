<?php


namespace Test\Unit\Messenger\Infrastructure\Filesystem;


use App\Messenger\Application\Query\User\UserView;
use App\Messenger\Infrastructure\Filesystem\Exception\UserNotFoundException;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use PHPUnit\Framework\TestCase;

class FileUserQueryTest extends TestCase
{

    private FileUserQuery $userQuery;

    public function setUp(): void
    {
        $this->userQuery = new FileUserQuery();
    }


    /** @test */
    public function it_returns_all_users(): void
    {
        $users = $this->userQuery->getAll();
        self::assertIsArray($users);
        self::assertCount(3, $users);
        self::assertInstanceOf(UserView::class, array_pop($users));
        self::assertCount(3, (array)$users[0]);
    }

    /** @test */
    public function it_returns_users_by_emails(): void
    {
        $emails = [
            'marek.kowalski@test.pl',
            'andrzej.kowalski@test.pl'
        ];
        $users = $this->userQuery->getByEmails($emails);
        self::assertIsArray($users);
        self::assertCount(2, $users);
        self::assertInstanceOf(UserView::class, $users[0]);
        self::assertCount(3, (array)$users[0]);
    }

    /** @test */
    public function it_returns_correct_user_information_by_email(): void
    {
        $emails = [
            'andrzej.kowalski@test.pl'
        ];
        $users = $this->userQuery->getByEmails($emails);
        self::assertIsArray($users);
        self::assertCount(1, $users);
        $user = $users[0];
        self::assertEquals('andrzej.kowalski', $user->getLogin());
        self::assertEquals('andrzej.kowalski@test.pl', $user->getEmail());
        self::assertEquals('email,sms', $user->getContactChannels());
    }

    /** @test */
    public function it_throws_exception_when_user_with_given_email_is_not_found(): void
    {
        $emails = [
            'test@test.pl'
        ];
        $this->expectException(UserNotFoundException::class);
        $this->userQuery->getByEmails($emails);

    }
}