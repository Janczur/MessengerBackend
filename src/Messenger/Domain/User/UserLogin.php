<?php


namespace App\Messenger\Domain\User;


class UserLogin
{

    /** @var string */
    private string $login;

    /**
     * @param string $login
     */
    public function __construct(string $login)
    {
        $this->login = $login;
    }

}