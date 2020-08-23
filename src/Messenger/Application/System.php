<?php


namespace App\Messenger\Application;


use App\Messenger\Application\Command\Command;
use App\Messenger\Application\CommandBus\CommandBusInterface;
use App\Messenger\Application\Query\Query;

class System implements SystemInterface
{

    private CommandBusInterface $commandBus;

    /**
     * System constructor.
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(Command $command): void
    {
        $this->commandBus->handle($command);
    }

    public function query(string $queryClass): Query
    {
        return new $queryClass;
    }
}