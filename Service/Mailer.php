<?php

namespace ProjetNormandie\EmailBundle\Service;

use ProjetNormandie\EmailBundle\Entity\Email;
use ProjetNormandie\EmailBundle\Mapper\SwiftMailerMapper;

class Mailer
{
    /** @var \Swift_Mailer */
    protected $mailer;
    /** @var \ProjetNormandie\EmailBundle\Mapper\SwiftMailerMapper */
    protected $mapper;
    /** @var string */
    protected $from;

    /**
     * @param \Swift_Mailer $mailer
     * @param \ProjetNormandie\EmailBundle\Mapper\SwiftMailerMapper $mapper
     * @param string $from
     */
    public function __construct(\Swift_Mailer $mailer, SwiftMailerMapper $mapper, $from)
    {
        $this->mailer = $mailer;
        $this->mapper = $mapper;
        $this->from = $from;
    }

    /**
     * Sends the mail updating the entity status.
     *
     * @param \ProjetNormandie\EmailBundle\Entity\Email $email
     * @return \ProjetNormandie\EmailBundle\Entity\Email
     */
    public function send(Email $email)
    {
        if (null !== $email->getFrom()) {
            $email->setFrom($this->from);
        }
        $message = $this->mapper->fromEmail($email);

        $state = $this->mailer->send($message);

        if (\Swift_Events_SendEvent::RESULT_SUCCESS === $state) {
            $email
                ->setSentState(true)
                ->setSentDate(new \DateTime());
        }

        return $email;
    }

    /**
     * @param string $from
     * @return Mailer
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }
}
