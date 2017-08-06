<?php

namespace ProjetNormandie\EmailBundle\Entity;

/**
 * Interface that defines the rules that must respect the User objects instances.
 */
interface UserInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getEmail();
}
