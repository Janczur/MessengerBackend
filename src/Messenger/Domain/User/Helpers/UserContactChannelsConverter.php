<?php


namespace App\Messenger\Domain\User\Helpers;


class UserContactChannelsConverter
{

    public static function toArray(string $contactChannels, $delimiter = ',')
    {
        return explode($delimiter, $contactChannels);
    }

}