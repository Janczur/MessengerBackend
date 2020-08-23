<?php


namespace App\Messenger\Application\Service\CommandBus;


use App\Messenger\Application\Command\Command;

interface CommandBusInterface
{
    public function handle(Command $command): void;
}