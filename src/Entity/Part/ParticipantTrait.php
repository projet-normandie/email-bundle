<?php

namespace ProjetNormandie\EmailBundle\Entity\Part;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait that is representing a sender and a recipient.
 */
trait ParticipantTrait
{
    /**
     * @ORM\Column(name="emailFrom", type="string", length=255, nullable=false)
     */
    private string $from;

    /**
     * @ORM\Column(name="emailTo", type="string", length=255, nullable=false)
     */
    private string $to;

    /**
     * Get the recipient mail.
     * @return string
     */
    public function getTargetMail(): string
    {
        return $this->to;
    }

    /**
     * Set the recipient mail.
     * @param string $targetMail
     * @return $this
     */
    public function setTargetMail(string $targetMail): self
    {
        $this->to = $targetMail;
        return $this;
    }

    /**
     * Get the sender mail.
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * Set the sender mail.
     * @param mixed $from
     * @return $this
     */
    public function setFrom($from): self
    {
        $this->from = $from;
        return $this;
    }
}
