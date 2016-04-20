<?php

namespace ProjetNormandie\EmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity
 */
class Email
{
    const STATE_FAILED = 0;
    const STATE_SUCCES = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="emailId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $emailId;

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
    private $attachments;

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
     * @var \ProjetNormandie\EmailBundle\Entity\UserInterface
     *
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\EmailBundle\Entity\UserInterface")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target", referencedColumnName="userId")
     * })
     */
    private $target;

    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->sentState = false;
    }

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
     * @return \ProjetNormandie\EmailBundle\Entity\UserInterface
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param \ProjetNormandie\EmailBundle\Entity\UserInterface $target
     * @return Email
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return string
     */
    public function getTargetMail()
    {
        return $this->to;
    }

    /**
     * @param string $targetMail
     * @return Email
     */
    public function setTargetMail($targetMail)
    {
        $this->to = $targetMail;
        return $this;
    }

    /**
     * @param mixed $from
     * @return Email
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }
}
