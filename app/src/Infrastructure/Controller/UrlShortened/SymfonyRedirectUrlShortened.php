<?php

namespace App\Infrastructure\Controller\UrlShortened;

use App\Application\UrlShortened\Read\ReadUrlShortened;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SymfonyRedirectUrlShortened extends AbstractController
{
    private ReadUrlShortened $readUrlShortened;

    public function __construct(ReadUrlShortened $readUrlShortened)
     {
         $this->readUrlShortened = $readUrlShortened;
     }

    /**
     * @Route("/urlshortened/redirect/{code}", methods="GET")
     * @param Request $request
     */
    public function redirectUrlShortened(Request $request)
    {
        try {
            $code = $request->get("code");
            $urlShortened = $this->readUrlShortened->read($code);
            $redirection = new RedirectResponse('/');
            $redirection->setTargetUrl($urlShortened->getUrl());

            return $redirection;
        } catch(NotFoundResourceException | \InvalidArgumentException $argumentException) {
            return new JsonResponse($argumentException->getMessage(), JsonResponse::HTTP_NOT_FOUND);
        }
    }
}