<?php

namespace ProjetNormandie\EmailBundle\Plugin;

use Doctrine\Common\Persistence\ObjectManager;
use ProjetNormandie\EmailBundle\Entity\Email;
use Swift_Events_SendEvent;

class SwiftMailerDatabaseLogger implements \Swift_Events_SendListener
{
    protected $objectManager;
    protected $email;

    public function __construct(ObjectManager $manager)
    {
        $this->objectManager = $manager;
        $this->email = new Email();
    }

    /**
     * @inheritDoc
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        $this->email
            ->setSubject($message->getSubject())
            ->setBodyHtml($message->getBody())
            ->setTargetMail($message->getTo());
    }

    /**
     * @inheritDoc
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        if ($evt->getResult() == Swift_Events_SendEvent::RESULT_SUCCESS) {
            $this->email->setSentState(true);
        }
        $this->objectManager->persist($this->email);
        $this->objectManager->flush();
    }
}
