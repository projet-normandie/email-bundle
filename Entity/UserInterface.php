<?php

namespace ProjetNormandie\EmailBundle\Entity;

interface UserInterface
{
    /**
     * @return int
     */
    public function getUserId();
    /**
     * @return string
     */
    public function getEmail();
}
