<?php

namespace App\Infrastructure\Controller\UrlShortened;

use App\Application\UrlShortened\Create\CreateUrlShortened;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SymfonyCreateUrlShortened extends AbstractController
{
    /** @var CreateUrlShortened */
    private $createUrlShortened;

    public function __construct(CreateUrlShortened $createUrlShortened)
    {
        $this->createUrlShortened = $createUrlShortened;
    }

    /**
     * @Route("/urlshortened/create", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createUrlShortened(Request $request) :JsonResponse
    {
        $url = json_decode($request->getContent())->url;
        $urlShortened = $this->createUrlShortened->create($url);
        return new JsonResponse('Created ' . $urlShortened->getCode(), Response::HTTP_OK);
    }
}