<?php

namespace ProjetNormandie\EmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\EmailBundle\Entity\Part;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity
 */
class Email implements TimestampableInterface
{
    use TimestampableTrait;

    // Includes the recipient and the sender mails.
    use Part\ParticipantTrait;

    // Includes the body to HTML and text format, the subject and the attachments.
    use Part\MessageTrait;


    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $id = null;

    /**
     * Email Constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Email
     */
    public function setId(int $id): Email
    {
        $this->id = $id;
        return $this;
    }
}
