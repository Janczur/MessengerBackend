<?php


namespace App\Messenger\Domain\User\Exception;


class InvalidContactChannelException extends \Exception
{

    protected $message = 'Użytkownik ma zdefiniowany nieprawidłowy kanał komunikacyjny';

}