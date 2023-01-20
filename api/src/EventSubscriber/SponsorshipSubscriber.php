<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Sponsorship;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Security;

final class SponsorshipSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $security;

    public function __construct(MailerInterface $mailer, Security $security)
    {
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(ViewEvent $event): void
    {
        $sponsorship = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$sponsorship instanceof Sponsorship || Request::METHOD_POST !== $method) {
            return;
        }

        $sponsor = $this->security->getUser();
        $sponsored = $sponsorship->getSponsored();

        if (!$sponsor instanceof User || !$sponsored instanceof User) {
            return;
        }

        $email = (new Email())
            ->from($_ENV['MAILER_FROM'])
            ->to($sponsored->getEmail())
            ->subject('Sponsorship request')
            ->html('<p>Hi ' . $sponsored->getUsername() . ',</p>
            <p>' . $sponsor->getUsername() . ' wants to sponsor you.</p>
            <p>Click on the link below to validate the sponsorship.</p>
            <p><a href="http://localhost:8080/sponsorships/validate/' . $sponsorship->getId() . '">Validate sponsorship</a></p>
            <p>Thanks,</p>
            <p>Thunderous Knockout Fighting</p>');

        $this->mailer->send($email);
    }
}
