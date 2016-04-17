<?php

namespace ProjetNormandie\EmailBundle\Mapper;

use ProjetNormandie\EmailBundle\Entity\Email;

class SwiftMailerMapper
{
    /**
     * Transforms an Email entity to a Swift_Message.
     *
     * @param \ProjetNormandie\EmailBundle\Entity\Email $emailEntity
     * @return \Swift_Message
     */
    public function fromEmail(Email $emailEntity)
    {
        $message = new \Swift_Message();
        $message
            ->setSubject($emailEntity->getSubject())
            ->setTo([$emailEntity->getTargetMail()])
            ->setFrom($emailEntity->getFrom())
            ->setBody($emailEntity->getBodyHtml(), 'text/html')
            ->addPart($emailEntity->getBodyText(), 'text/plain');

        if (0 < count($emailEntity->getAttachments())) {
            foreach ($emailEntity->getAttachments() as $name => $attachment) {
                $file = \Swift_Attachment::fromPath($attachment);
                if (!is_int($name)) {
                    $file->setFilename($name);
                }
                $message->attach($file);
            }
        }

        return $message;
    }
}
