<?php


namespace App\Messenger\Application\CommandBus;


use App\Messenger\Application\Command\Command;

interface CommandBusInterface
{
    public function handle(Command $command): void;
}