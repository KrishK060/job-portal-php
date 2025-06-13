<?php

namespace App\MessageHandler;

use App\Message\OnRegistrationSendEmail;
use App\Message\OnRegistrationSendEmail as MessageOnRegistrationSendEmail;
use App\Message\OnRejectSendEmail;
use App\Message\OnShortlistSendEmail;
use App\Repository\ApplicationsRepository;
use Doctrine\ORM\Persisters\Collection\OneToManyPersister;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Messenger\MessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class OnShortlistSendEmailHandler implements MessageHandlerInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(OnShortlistSendEmail $event)
    {
        $email = (new Email())
            ->from(new Address('specialagent0601@gmail.com', 'The Space Bar'))
            ->to(new Address($event->getUserEmailId()))
            ->subject('status update ')
            ->text('Your resusume is shortlisted');
        $this->mailer->send($email);
    }
}
