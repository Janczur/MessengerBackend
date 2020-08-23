<?php


namespace App\Messenger\Application;


use App\Messenger\Application\Command\Command;
use App\Messenger\Application\Query\Query;

interface SystemInterface
{

    public function handle(Command $command): void;

    public function query(string $queryClass): Query;

}