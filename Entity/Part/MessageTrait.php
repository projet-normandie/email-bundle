<?php

namespace ProjetNormandie\EmailBundle\Entity\Part;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait that is representing all that represent a message (subject, bodies ...).
 */
trait MessageTrait
{
    /**
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private string $subject;

    /**
     * @ORM\Column(name="bodyText", type="text", nullable=true)
     */
    private string $bodyText;

    /**
     * @ORM\Column(name="bodyHtml", type="text", nullable=false)
     */
    private string $bodyHtml;

    /**
     * Get the subject of the message.
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Set the subject of the message.
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get the body of the message, in text format.
     * @return string
     */
    public function getBodyText(): string
    {
        return $this->bodyText;
    }

    /**
     * Set the body of the message, in text format.
     * @param string $bodyText
     * @return $this
     */
    public function setBodyText(string $bodyText): self
    {
        $this->bodyText = $bodyText;
        return $this;
    }

    /**
     * Get the body of the message, in HTML format.
     * @return string
     */
    public function getBodyHtml(): string
    {
        return $this->bodyHtml;
    }

    /**
     * Set the body of the message, in HTML format.
     * @param string $bodyHtml
     * @return $this
     */
    public function setBodyHtml(string $bodyHtml): self
    {
        $this->bodyHtml = $bodyHtml;
        return $this;
    }
}
