<?php

namespace App\Application\UrlShortened\Read;

use App\Domain\UrlsShortened\UrlShortenedRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ReadUrlShortened
{
    private UrlShortenedRepository $urlShortenedRepository;

    public function __construct(UrlShortenedRepository $urlShortenedRepository)
    {
        $this->urlShortenedRepository = $urlShortenedRepository;
    }

    public function read(String $code)
    {
        $urlShortened = $this->urlShortenedRepository->findUrlShortenedByCode($code);

        if(!$urlShortened) {
            throw new NotFoundResourceException("not found");
        }
        if($urlShortened && $urlShortened->isDeleted()) {
            throw new \InvalidArgumentException("that url has been deleted");
        }
        $urlShortened->setRedirections($urlShortened->getRedirections() + 1);
        $this->urlShortenedRepository->saveUrlShortened($urlShortened);
        return $urlShortened;
    }
}