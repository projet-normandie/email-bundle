<?php

namespace ProjetNormandie\EmailBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\EmailBundle\Mapper\MailerMapper;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * Proxy to use the Swift_Mailer with the user class SwiftMailerMapper.
 */
class Mailer
{
    protected MailerInterface $mailer;
    protected MailerMapper $mapper;
    private EntityManagerInterface $em;
    private string $from;
    private string $to;

    /**
     * @param MailerInterface        $mailer
     * @param MailerMapper           $mapper
     * @param EntityManagerInterface $em
     * @param string                 $pnEmailFrom
     * @param string                 $pnEmailTo
     */
    public function __construct(MailerInterface $mailer, MailerMapper $mapper, EntityManagerInterface $em, string $pnEmailFrom, string $pnEmailTo)
    {
        $this->mailer = $mailer;
        $this->mapper = $mapper;
        $this->em = $em;
        $this->from = $pnEmailFrom;
        $this->to = $pnEmailTo;
    }

    /**
     * @param String      $subject
     * @param String      $body
     * @param String|null $from
     * @param String|null $to
     * @return void
     * @throws TransportExceptionInterface
     */
    public function send(String $subject, String $body, String $from = null, String $to = null)
    {
        $email = new Email();
        $email->subject($subject);
        $email->html($body);
        $email->text($body);

        if ($from !== null) {
            $email->replyTo($from);
        }
        $email->from($this->from);

        if (null !== $to) {
            $email->to($to);
        } else {
            $email->to($this->to);
        }

        $this->mailer->send($email);

        $entity = $this->mapper->fromEmail($email);
        $this->em->persist($entity);
        $this->em->flush();
    }
}
