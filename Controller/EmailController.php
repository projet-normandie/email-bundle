<?php

namespace ProjetNormandie\EmailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ProjetNormandie\EmailBundle\Service\Mailer;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Controller used to manage email contents in the public part of the site.
 */
class EmailController extends AbstractController
{

    private $mailer;
    private $translator;

    /**
     * EmailController constructor.
     * @param Mailer              $mailer
     * @param TranslatorInterface $translator
     */
    public function __construct(Mailer $mailer, TranslatorInterface $translator)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function send(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $this->mailer->send(
            $data['subject'],
            $data['message'],
            $this->getParameter('projetnormandie_email.to'),
            $data['email']
        );


        return $this->getResponse(
            true,
            $this->translator->trans('email.success')
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
