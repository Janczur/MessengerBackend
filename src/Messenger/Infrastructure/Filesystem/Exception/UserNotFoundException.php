<?php


namespace App\Messenger\Infrastructure\Filesystem\Exception;


class UserNotFoundException extends \Exception
{
    protected $message = 'Podany użytkownik nie istnieje';
}