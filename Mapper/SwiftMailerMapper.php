<?php

namespace ProjetNormandie\EmailBundle\Mapper;

use ProjetNormandie\EmailBundle\Entity\Email;
use ProjetNormandie\EmailBundle\Infrastructure\AttachmentManager;
use Swift_Message;

/**
 * Mapper class upon the Swift_Mailer to send Swift_Messages.
 */
class SwiftMailerMapper
{
    /**
     * Transforms an Email entity to a Swift_Message.
     *
     * @param Email $emailEntity
     * @return Swift_Message
     */
    public function fromEmail(Email $emailEntity)
    {
        $message = (new Swift_Message())
            ->setSubject($emailEntity->getSubject())
            ->setTo([$emailEntity->getTargetMail()])
            ->setFrom($emailEntity->getFrom())
            ->setBody($emailEntity->getBodyHtml());

        foreach ($emailEntity->getAttachments() as $name => $attachment) {
            $message->attach(AttachmentManager::buildSwift($attachment, $name));
        }

        return $message;
    }
}
