<?php


namespace Test\Unit\Messenger\Domain\User;


use App\Messenger\Domain\User\Exception\InvalidContactChannelException;
use App\Messenger\Domain\User\UserContactChannels;
use PHPUnit\Framework\TestCase;

class UserContactChannelsTest extends TestCase
{

    /** @test */
    public function that_we_can_create_contact_channels_with_valid_data(): void
    {
        $contactChannels = new UserContactChannels('sms,email');
        self::assertInstanceOf(UserContactChannels::class, $contactChannels);
    }

    /** @test */
    public function that_we_cannot_create_contact_channels_if_at_least_one_channel_is_not_valid(): void
    {
        $this->expectException(InvalidContactChannelException::class);
        new UserContactChannels('test,email');
    }
}