<?php

namespace ProjetNormandie\EmailBundle\Entity\Part;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait that is representing a sender and a recipient.
 */
trait ParticipantTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="emailFrom", type="string", length=255, nullable=false)
     */
    private $from;

    /**
     * Stored as User can change its mail address.
     * @var string
     *
     * @ORM\Column(name="emailTo", type="string", length=255, nullable=false)
     */
    private $to;

    /**
     * Get the recipient mail.
     * @return string
     */
    public function getTargetMail()
    {
        return $this->to;
    }

    /**
     * Set the recipient mail.
     * @param string $targetMail
     * @return $this
     */
    public function setTargetMail($targetMail)
    {
        $this->to = $targetMail;
        return $this;
    }

    /**
     * Get the sender mail.
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the sender mail.
     * @param mixed $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }
}
