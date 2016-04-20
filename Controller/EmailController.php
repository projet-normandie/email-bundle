<?php

namespace ProjetNormandie\EmailBundle\Controller;

use ProjetNormandie\EmailBundle\Entity\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class EmailController extends Controller
{
    /**
     * @Route("/{emailId}", name="email_display")
     *
     * @param \ProjetNormandie\EmailBundle\Entity\Email $email
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Email $email)
    {
        $user = $this->getUser();
        if ($email->getTarget()->getUserId() !== $user->getUserId()) {
            return new AccessDeniedException();
        }

        return $this->render(
            'ProjetNormandieEmailBundle:Email:show.html.twig',
            ["email" => $email]
        );
    }
}
