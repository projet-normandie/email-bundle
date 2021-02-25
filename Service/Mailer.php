<?php

namespace ProjetNormandie\EmailBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
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
    /** @var string */
    protected $to;
    /** @var EntityManagerInterface */
    private $em;


    /**
     * Mailer constructor.
     * @param Swift_Mailer           $mailer
     * @param SwiftMailerMapper      $mapper
     * @param EntityManagerInterface $em
     * @param string                 $from
     * @param string                 $to
     */
    public function __construct(Swift_Mailer $mailer, SwiftMailerMapper $mapper, EntityManagerInterface $em, $from = '', $to = '')
    {
        $this->mailer = $mailer;
        $this->mapper = $mapper;
        $this->em = $em;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param String      $subject
     * @param String      $body
     * @param String|null $to
     * @param String|null $from
     * @return mixed
     */
    public function send(String $subject, String $body, String $to = null, String $from = null)
    {
        $entity = new Email();
        $entity->setSubject($subject);
        $entity->setBodyHtml($body);
        $entity->setBodyText($body);

        if (null === $to) {
            $entity->setTargetMail($this->to);
        } else {
            $entity->setTargetMail($to);
        }

        if (null === $from) {
            $entity->setFrom($this->from);
        } else {
            $entity->setFrom($from);
        }

        $this->em->persist($entity);
        $this->em->flush();

        $message = $this->mapper->fromEmail($entity);

        // Try to send the mail.
        $state = $this->mailer->send($message);

        /*$deliveryStatus = (Swift_Events_SendEvent::RESULT_SUCCESS === $state);

        $email->setSentState($deliveryStatus)
            ->setSentDate($deliveryStatus ? new DateTime() : null);*/
    }

    /**
     * @param string $from
     * @return $this
     */
    public function setFrom(string $from): Mailer
    {
        $this->from = $from;
        return $this;
    }
}
