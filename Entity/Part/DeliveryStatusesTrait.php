<?php

namespace ProjetNormandie\EmailBundle\Entity\Part;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait that is representing all statuses of the main object, including management of creations and deliveries.
 */
trait DeliveryStatusesTrait
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="sentState", type="boolean", nullable=false)
     */
    private $sentState;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sentDate", type="datetime", nullable=true)
     */
    private $sentDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * Get the status of the delivery. TRUE if sent. FALSE otherwise.
     * @return boolean
     */
    public function isSentState()
    {
        return $this->sentState;
    }

    /**
     * Set the status of the delivery. TRUE if sent. FALSE otherwise.
     * @param boolean $sentState
     * @return $this
     */
    public function setSentState($sentState)
    {
        $this->sentState = $sentState;
        return $this;
    }

    /**
     * Get the date and time when the message has been sent.
     * @return \DateTime
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * Set the date and time when the message has been sent.
     * @param \DateTime $sentDate
     * @return $this
     */
    public function setSentDate(\DateTime $sentDate)
    {
        $this->sentDate = $sentDate;
        return $this;
    }

    /**
     * Get the date and time when the message has been created.
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the date and time when the message has been created.
     * @param \DateTime $creationDate
     * @return $this
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }
}
