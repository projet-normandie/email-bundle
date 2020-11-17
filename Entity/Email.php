<?php

namespace ProjetNormandie\EmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\EmailBundle\Entity\Part;
use DateTime;

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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\EmailBundle\Entity\UserInterface")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * Email Constructor.
     */
    public function __construct()
    {
        $this->setCreationDate(new DateTime())
            ->setSentState(false);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Email
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return Email
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }
}
