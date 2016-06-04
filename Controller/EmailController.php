<?php

namespace ProjetNormandie\EmailBundle\Controller;

use ProjetNormandie\EmailBundle\Entity\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller used to manage email contents in the public part of the site.
 */
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
        if ($email->getTarget()->getId() !== $user->getUserId()) {
            return new AccessDeniedException();
        }

        return $this->render(
            'ProjetNormandieEmailBundle:Email:show.html.twig',
            ["email" => $email]
        );
    }
}
