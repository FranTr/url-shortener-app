<?php

namespace App\Application\UrlShortened\Delete;

use App\Domain\UrlsShortened\UrlShortenedRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class DeleteUrlShortened
{
    private UrlShortenedRepository $urlShortenedRepository;

    public function __construct(UrlShortenedRepository $urlShortenedRepository)
    {
        $this->urlShortenedRepository = $urlShortenedRepository;
    }

    public function delete(string $code): void
    {
        $urlShortenedToDelete = $this->urlShortenedRepository->findUrlShortenedByCode($code);

        if (!$urlShortenedToDelete) {
            throw new NotFoundResourceException("shortened url not found");
        }
        if ($urlShortenedToDelete && $urlShortenedToDelete->isDeleted()) {
            throw new \InvalidArgumentException("shortened url already deleted");
        }

        $urlShortenedToDelete->setIsDeleted(true);
        $this->urlShortenedRepository->saveUrlShortened($urlShortenedToDelete);
    }
}