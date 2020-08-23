<?php


namespace App\Messenger\Application\Query\User;


interface UserQueryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param array $userEmails
     * @return UserView[]
     */
    public function getByEmails(array $userEmails): array;
}