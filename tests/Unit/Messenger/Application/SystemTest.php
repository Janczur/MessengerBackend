<?php


namespace Test\Unit\Messenger\Application;


use App\Messenger\Application\Command\Email\SendEmailToUser;
use App\Messenger\Application\Query\User\UserView;
use App\Messenger\Application\SystemInterface;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{

    /** @test */
    public function it_handles_commands_properly(): void
    {
        $systemMock = $this->createMock(SystemInterface::class);
        $systemMock->expects(self::once())
            ->method('handle');
        $userView = new UserView('testowy-login', 'test@test.pl', 'test-sms,test-email');
        $emailCommand = new SendEmailToUser('Wiadomość', $userView);
        $systemMock->handle($emailCommand);
    }

    /** @test */
    public function it_instantiate_queries_classes_properly(): void
    {
        $systemMock = $this->createMock(SystemInterface::class);
        $systemMock->expects(self::once())
            ->method('query')
            ->willReturn(new FileUserQuery());
        $systemMock->query(FileUserQuery::class);
    }
}