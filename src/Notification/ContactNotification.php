<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;

class ContactNotification {

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer) {
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact){
        $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to($contact->getDepartment()->getManager()->getEmail())
            ->subject('OnboardingOne email de '.$contact->getFirstname())
            ->htmlTemplate('emails/contact_email.html.twig')
            ->context(['firstname' => $contact->getFirstname(),
                    'lastname' => $contact->getLastname(),
                    'message'=> $contact->getMessage(),
                    'user_email'=> $contact->getEmail()]);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            echo 'can\'t send email';
            echo $e->getMessage();
        }
    }

}