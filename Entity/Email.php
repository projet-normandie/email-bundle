<?php

namespace ProjetNormandie\EmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\EmailBundle\Entity\Part;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity
 */
class Email
{
    // Includes the recipient and the sender mails.
    use Part\ParticipantTrait;

    // Includes the body to HTML and text format, the subject and the attachments.
    use Part\MessageTrait;

    // Includes the creation date and time, delivery status and delivery date and time.
    use Part\DeliveryStatusesTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="emailId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $emailId;

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\EmailBundle\Entity\UserInterface")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target", referencedColumnName="id")
     * })
     */
    private $target;

    /**
     * Email Constructor.
     */
    public function __construct()
    {
        $this->setCreationDate(new \DateTime())
            ->setSentState(false);
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
     * @return UserInterface
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param UserInterface $target
     * @return Email
     */
    public function setTarget(UserInterface $target)
    {
        $this->target = $target;
        return $this;
    }
}
