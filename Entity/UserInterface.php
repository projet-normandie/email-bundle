<?php

namespace ProjetNormandie\EmailBundle\Entity;

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
