<?php

namespace ProjetNormandie\EmailBundle\Entity\Part;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait that is representing all that represent a message (subject, bodies, attachments, ...).
 */
trait MessageTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="bodyText", type="text", nullable=true)
     */
    private $bodyText;

    /**
     * @var string
     *
     * @ORM\Column(name="bodyHtml", type="text", nullable=false)
     */
    private $bodyHtml;

    /**
     * @var array
     *
     * @ORM\Column(name="attachments", type="json_array", nullable=true)
     */
    private $attachments = [];

    /**
     * Get the subject of the message.
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the subject of the message.
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get the body of the message, in text format.
     * @return string
     */
    public function getBodyText()
    {
        return $this->bodyText;
    }

    /**
     * Set the body of the message, in text format.
     * @param string $bodyText
     * @return $this
     */
    public function setBodyText($bodyText)
    {
        $this->bodyText = $bodyText;
        return $this;
    }

    /**
     * Get the body of the message, in HTML format.
     * @return string
     */
    public function getBodyHtml()
    {
        return $this->bodyHtml;
    }

    /**
     * Set the body of the message, in HTML format.
     * @param string $bodyHtml
     * @return $this
     */
    public function setBodyHtml($bodyHtml)
    {
        $this->bodyHtml = $bodyHtml;
        return $this;
    }

    /**
     * Get the attachments.
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set the attachments. For a better usage, please send an associative array where keys are recipient file names.
     * @param array $attachments
     * @return $this
     */
    public function setAttachments(array $attachments)
    {
        $this->attachments = $attachments;
        return $this;
    }
}
