<?php


namespace Test\Unit\cli\Command;


use App\Messenger\Application\SystemInterface;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use Cli\Command\SendMessage;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class SendMessageTest extends TestCase
{
    private CommandTester $commandTester;
    private SystemInterface $system;

    public function setUp(): void
    {
        $system = $this->createMock(SystemInterface::class);
        $system->expects(self::once())
            ->method('query')
            ->willReturn(new FileUserQuery());
        $application = new Application();
        $application->add(new SendMessage($system));
        $command = $application->find('send-message');
        $this->system = $system;
        $this->commandTester = new CommandTester($command);
    }

    /** @test */
    public function it_properly_sends_message_to_given_users(): void
    {
        $this->commandTester->setInputs(['yes']);
        $this->system->expects(self::once())->method('handle');
        $this->commandTester->execute([
            'message' => 'Testowa wiadomość',
            'userEmails' => [
                'test@test.pl',
                'jan.kowalski@test.pl'
            ]
        ]);
        self::assertStringContainsString('Sukces!', $this->commandTester->getDisplay());
    }

    /** @test */
    public function it_aborts_the_operation_if_user_decides_so(): void
    {
        $this->commandTester->setInputs(['no']);
        $this->commandTester->execute([
            'message' => 'Testowa wiadomość'
        ]);
        self::assertStringContainsString('Aborcja!', $this->commandTester->getDisplay());
    }

}