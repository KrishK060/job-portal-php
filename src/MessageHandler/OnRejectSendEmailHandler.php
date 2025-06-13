<?php

namespace App\MessageHandler;

use App\Message\OnRegistrationSendEmail;
use App\Message\OnRegistrationSendEmail as MessageOnRegistrationSendEmail;
use App\Message\OnRejectSendEmail;
use App\Repository\ApplicationsRepository;
use Doctrine\ORM\Persisters\Collection\OneToManyPersister;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Messenger\MessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class OnRejectSendEmailHandler implements MessageHandlerInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(OnRejectSendEmail $event)
    {
        $email = (new Email())
            ->from(new Address('specialagent0601@gmail.com', 'The Space Bar'))
            ->to(new Address($event->getUserEmailId()))
            ->subject('status update ')
            ->text('Your resusume is not shortlisted');
        $this->mailer->send($email);
    }
}
