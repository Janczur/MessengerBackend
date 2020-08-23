<?php


namespace App\Messenger\Application\Command\Email;


use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendEmailToUserHandler
{
    public function handle(SendEmailToUser $command): void
    {
        $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
        $symfonyMailer = new Mailer($transport);
        $email = (new Email())
            ->from(new Address($_ENV['MAILER_FROM'], $_ENV['APP_NAME']))
            ->to($command->getUser()->getEmail())
            ->subject('Fajnie jest')
            ->text($command->getMessage());

        $symfonyMailer->send($email);
    }

}