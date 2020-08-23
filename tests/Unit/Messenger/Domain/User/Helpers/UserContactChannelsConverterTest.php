<?php


namespace Test\Unit\Messenger\Domain\User\Helpers;


use App\Messenger\Domain\User\Helpers\UserContactChannelsConverter;
use PHPUnit\Framework\TestCase;

class UserContactChannelsConverterTest extends TestCase
{
    /** @test */

    public function it_converts_contact_channels_from_string_to_array_correctly(): void
    {
        $userChannels = 'sms,email,test';
        $expected = [
            'sms',
            'email',
            'test'
        ];
        $converted = UserContactChannelsConverter::toArray($userChannels);
        self::assertEquals($expected, $converted);
    }

}