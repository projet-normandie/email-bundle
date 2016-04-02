<?php

namespace ProjetNormandie\EmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email", indexes={@ORM\Index(name="IDX_E7927C74466F2FFC", columns={"target"})})
 * @ORM\Entity
 */
class Email
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
     * @ORM\Column(name="bodyText", type="text", nullable=false)
     */
    private $bodyText;

    /**
     * @var string
     *
     * @ORM\Column(name="bodyHtml", type="text", nullable=false)
     */
    private $bodyHtml;

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
     * @var array
     *
     * @ORM\Column(name="attachments", type="json_array", nullable=true)
     */
    private $attachments;

    /**
     * @var integer
     *
     * @ORM\Column(name="emailId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $emailId;

    /**
     * @var \ProjetNormandie\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target", referencedColumnName="userId")
     * })
     */
    private $target;

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getBodyText()
    {
        return $this->bodyText;
    }

    /**
     * @param string $bodyText
     * @return Email
     */
    public function setBodyText($bodyText)
    {
        $this->bodyText = $bodyText;
        return $this;
    }

    /**
     * @return string
     */
    public function getBodyHtml()
    {
        return $this->bodyHtml;
    }

    /**
     * @param string $bodyHtml
     * @return Email
     */
    public function setBodyHtml($bodyHtml)
    {
        $this->bodyHtml = $bodyHtml;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSentState()
    {
        return $this->sentState;
    }

    /**
     * @param boolean $sentState
     * @return Email
     */
    public function setSentState($sentState)
    {
        $this->sentState = $sentState;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * @param \DateTime $sentDate
     * @return Email
     */
    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return Email
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     * @return Email
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param int $emailId
     * @return Email
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
        return $this;
    }

    /**
     * @return \ProjetNormandie\UserBundle\Entity\Member
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param \ProjetNormandie\UserBundle\Entity\Member $target
     * @return Email
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }
}
