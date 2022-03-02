<?php

namespace ProjetNormandie\EmailBundle\Mapper;

use ProjetNormandie\EmailBundle\Entity\Email as EmailEntity;
use Symfony\Component\Mime\Email;

/**
 * Mapper class upon the Swift_Mailer to send Swift_Messages.
 */
class MailerMapper
{
    /**
     * Transforms an Email message to an Email entity
     */
    public function fromEmail(Email $email): EmailEntity
    {
        $emailEntity =  (new EmailEntity())
            ->setSubject($email->getSubject())
            ->setTargetMail($email->getTo()[0]->toString())
            ->setBodyText($email->getTextBody())
            ->setBodyHtml($email->getHtmlBody());

        if (count($email->getFrom()) > 0) {
            $emailEntity->setFrom($email->getFrom()[0]->toString());
        }

        if (count($email->getReplyTo()) > 0) {
            $emailEntity->setFrom($email->getReplyTo()[0]->toString());
        }

        return $emailEntity;
    }
}
