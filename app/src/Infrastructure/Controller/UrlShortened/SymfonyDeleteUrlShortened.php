<?php

namespace App\Infrastructure\Controller\UrlShortened;

use App\Application\UrlShortened\Delete\DeleteUrlShortened;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SymfonyDeleteUrlShortened extends AbstractController
{

    private DeleteUrlShortened $deleteUrlShortened;

    public function __construct(DeleteUrlShortened $deleteUrlShortened)
    {
        $this->deleteUrlShortened = $deleteUrlShortened;
    }

    /**
     * @Route("/urlshortened/delete/{code}", methods="GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUrlShortened(Request $request)
    {
        try {
            $code = $request->get("code");
            $this->deleteUrlShortened->delete($code);
            return new JsonResponse("deleted " . $code, JsonResponse::HTTP_OK);
        } catch (\InvalidArgumentException
        | NotFoundResourceException $exception ) {
            return new JsonResponse($exception->getMessage(), JsonResponse::HTTP_NOT_FOUND);
        }
    }
}