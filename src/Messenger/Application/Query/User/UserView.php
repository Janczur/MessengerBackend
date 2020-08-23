<?php


namespace App\Messenger\Application\Query\User;


final class UserView
{
    /** @var string  */
    private string $login;

    /** @var string  */
    private string $email;

    /** @var string|null  */
    private ?string $contactChannels;

    /**
     * UserView constructor.
     * @param string $login
     * @param string $email
     * @param string|null $contactChannels
     */
    public function __construct(string $login, string $email, ?string $contactChannels)
    {
        $this->login = $login;
        $this->email = $email;
        $this->contactChannels = $contactChannels;
    }

    public function getLogin():string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getContactChannels(): ?string
    {
        return $this->contactChannels;
    }


}