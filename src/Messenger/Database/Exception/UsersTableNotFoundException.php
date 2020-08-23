<?php


namespace App\Messenger\Database\Exception;


class UsersTableNotFoundException extends \Exception
{
    protected $message = 'Nie znaleziono tabeli z użytkownikami';
}