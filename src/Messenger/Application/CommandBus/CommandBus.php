<?php


namespace App\Messenger\Application\CommandBus;


use App\Messenger\Application\Command\Command;
use App\Messenger\Application\Command\Email\SendEmailToUser;
use App\Messenger\Application\Command\Email\SendEmailToUserHandler;
use App\Messenger\Application\Command\SendMessageToUsers;
use App\Messenger\Application\Command\SendMessageToUsersHandler;
use App\Messenger\Application\Command\Sms\SendSmsToUser;
use App\Messenger\Application\Command\Sms\SendSmsToUserHandler;
use PHPUnit\Framework\Assert;

class CommandBus implements CommandBusInterface
{
    private array $handlers = [
        SendMessageToUsers::class => SendMessageToUsersHandler::class,
        SendEmailToUser::class => SendEmailToUserHandler::class,
        SendSmsToUser::class => SendSmsToUserHandler::class
    ];

    public function handle(Command $command): void
    {
        Assert::assertArrayHasKey(get_class($command), $this->handlers);
        $handler = new $this->handlers[get_class($command)];
        $handler->handle($command);
    }
}