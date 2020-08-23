<?php


namespace App\Messenger\Domain\Message\Sms;


class SmsMessage
{
    private string $phone;
    private string $content;

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }


    /**
     * @param string $phone
     * @return SmsMessage
     */
    public function setPhone(string $phone): SmsMessage
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string $content
     * @return SmsMessage
     */
    public function setContent(string $content): SmsMessage
    {
        $this->content = $content;
        return $this;
    }

}