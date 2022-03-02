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

    /**
     * Mailer constructor.
     * @param MailerInterface        $mailer
     * @param MailerMapper           $mapper
     * @param EntityManagerInterface $em
     */
    public function __construct(MailerInterface $mailer, MailerMapper $mapper, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->mapper = $mapper;
        $this->em = $em;
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
        $email->from($_ENV['MAILER_FROM']);

        if (null !== $to) {
            $email->to($to);
        } else {
            $email->to($_ENV['MAILER_TO']);
        }

        $this->mailer->send($email);

        $entity = $this->mapper->fromEmail($email);
        $this->em->persist($entity);
        $this->em->flush();
    }
}
