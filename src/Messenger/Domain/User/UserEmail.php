<?php


namespace App\Messenger\Domain\User;


class UserEmail
{
    /** @var string */
    private string $email;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }


}