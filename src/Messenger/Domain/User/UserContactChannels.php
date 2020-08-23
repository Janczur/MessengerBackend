<?php


namespace App\Messenger\Domain\User;


use App\Messenger\Domain\User\Exception\InvalidContactChannelException;
use App\Messenger\Domain\User\Helpers\UserContactChannelsConverter;

class UserContactChannels
{
    public const VALID_CONTACT_CHANNELS = [
        'email', 'sms',
    ];

    /** @var string|null */
    private ?string $contactChannels;

    /**
     * @param string|null $contactChannels
     * @throws InvalidContactChannelException
     */
    public function __construct(?string $contactChannels)
    {
        $this->contactChannels = null;

        if ($contactChannels) {
            $usersContactChannels = UserContactChannelsConverter::toArray($contactChannels);
            if (!$this->userContactChannelsAreValid($usersContactChannels)) {
                throw new InvalidContactChannelException();
            }
            $this->contactChannels = $contactChannels;

        }
    }

    private function userContactChannelsAreValid(array $usersContactChannels): bool
    {
        return count(array_intersect($usersContactChannels, self::VALID_CONTACT_CHANNELS)) ===
            count($usersContactChannels);
    }


}