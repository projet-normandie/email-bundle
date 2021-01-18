<?php

namespace ProjetNormandie\EmailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ProjetNormandie\EmailBundle\Entity\Email;
use ProjetNormandie\EmailBundle\Service\Mailer;

/**
 * Controller used to manage email contents in the public part of the site.
 */
class EmailController extends AbstractController
{

    private $mailer;

    /**
     * @param Mailer                   $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function send(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $subject = $data['subject'];
        $message = $data['message'];

        $mail = new Email();
        $mail
            ->setFrom($email)
            ->setTargetMail($this->getParameter('projetnormandie_email.to') )
            ->setSubject($subject)
            ->setBodyHtml($message)
            ->setBodyText($message);

        $this->mailer->send($mail);


        return $this->getResponse(
            true,
            'OK'
        );
    }

    /**
     * @param bool $success
     * @param null    $message
     * @return Response
     */
    private function getResponse(bool $success, $message = null)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'success' => $success,
            'message' => $message,
        ]));
        return $response;
    }
}
