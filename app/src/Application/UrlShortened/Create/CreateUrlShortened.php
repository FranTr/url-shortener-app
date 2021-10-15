<?php

namespace App\Application\UrlShortened\Create;

use App\Domain\UrlsShortened\UrlShortened;
use App\Domain\UrlsShortened\UrlShortenedRepository;
use Ramsey\Uuid\Uuid;


class CreateUrlShortened
{
    private $urlShortenedRepository;

    public function __construct(UrlShortenedRepository $urlShortenedRepository)
    {
        $this->urlShortenedRepository = $urlShortenedRepository;
    }

    public function create(string $url)
    {
        $code = Uuid::uuid4();
        $urlShortened = new UrlShortened($code, $url, 0, 0);

        $this->urlShortenedRepository->saveUrlShortened($urlShortened);
    }
}