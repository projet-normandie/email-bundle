<?php

namespace ProjetNormandie\EmailBundle\Service;

use ProjetNormandie\EmailBundle\Entity\Email;
use ProjetNormandie\EmailBundle\Mapper\SwiftMailerMapper;
use Swift_Mailer;
use Swift_Events_SendEvent;
use DateTime;

/**
 * Proxy to use the Swift_Mailer with the user class SwiftMailerMapper.
 */
class Mailer
{
    /** @var Swift_Mailer */
    protected $mailer;
    /** @var SwiftMailerMapper */
    protected $mapper;
    /** @var string */
    protected $from;

    /**
     * @param Swift_Mailer $mailer
     * @param SwiftMailerMapper $mapper
     * @param string $from
     */
    public function __construct(Swift_Mailer $mailer, SwiftMailerMapper $mapper, $from = '')
    {
        $this->mailer = $mailer;
        $this->mapper = $mapper;
        $this->from = $from;
    }

    /**
     * Sends the mail updating the entity status.
     *
     * @param Email $email
     * @return Email
     */
    public function send(Email $email)
    {
        if (null === $email->getFrom()) {
            $email->setFrom($this->from);
        }
        $message = $this->mapper->fromEmail($email);

        // Try to send the mail.
        $state = $this->mailer->send($message);

        $deliveryStatus = (Swift_Events_SendEvent::RESULT_SUCCESS === $state);

        $email->setSentState($deliveryStatus)
            ->setSentDate($deliveryStatus ? new DateTime() : null);

        return $email;
    }

    /**
     * @param string $from
     * @return Mailer
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
        return $this;
    }
}
