<?php

namespace ProjetNormandie\EmailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ProjetNormandie\EmailBundle\Service\Mailer;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Controller used to manage email contents in the public part of the site.
 */
class EmailController extends AbstractController
{

    private Mailer $mailer;
    private TranslatorInterface $translator;

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
     * @throws TransportExceptionInterface
     */
    public function send(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->mailer->send(
            $data['subject'],
            $data['message'],
            $data['email'],
            null

        );

        return $this->getResponse(
            $this->translator->trans('email.success')
        );
    }

    /**
     * @param string|null $message
     * @return Response
     */
    private function getResponse(string $message = null): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'success' => true,
            'message' => $message,
        ]));
        return $response;
    }
}
