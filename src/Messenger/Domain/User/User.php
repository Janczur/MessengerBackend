<?php


namespace App\Messenger\Domain\User;


class User
{
    /** @var UserLogin  */
    private UserLogin $login;

    /** @var UserEmail  */
    private UserEmail $email;

    /** @var UserContactChannels */
    private UserContactChannels $contactChannels;

    /**
     * @param UserLogin $login
     * @param UserEmail $email
     * @param UserContactChannels $contactChannels
     */
    public function __construct(UserLogin $login, UserEmail $email, UserContactChannels $contactChannels)
    {
        $this->login = $login;
        $this->email = $email;
        $this->contactChannels = $contactChannels;
    }


}