<?php


namespace App\Messenger\Database\Exception;


use Exception;

class UsersTableNotFoundException extends Exception
{
    protected $message = 'Nie znaleziono tabeli z użytkownikami';
}