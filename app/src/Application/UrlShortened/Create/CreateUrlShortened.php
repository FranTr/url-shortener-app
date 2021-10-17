<?php

namespace App\Application\UrlShortened\Create;

use App\Domain\UrlsShortened\UrlShortened;
use App\Domain\UrlsShortened\UrlShortenedRepository;
use Ramsey\Uuid\Uuid;


class CreateUrlShortened
{
    const HTTP = "http://";
    private $urlShortenedRepository;

    public function __construct(UrlShortenedRepository $urlShortenedRepository)
    {
        $this->urlShortenedRepository = $urlShortenedRepository;
    }

    public function create(string $url): UrlShortened
    {
        $url = $this->formatUrl($url);
        $urlShortened = $this->urlShortenedRepository->findUrlShortenedByUrl($url);

        if($urlShortened && !$urlShortened->isDeleted()) {
            return $urlShortened;
        }

        if($urlShortened && $urlShortened->isDeleted()) {
            $urlShortened->setIsDeleted(false);
            $this->urlShortenedRepository->saveUrlShortened($urlShortened);
            return $urlShortened;

        }
        $code = Uuid::uuid4();
        $urlShortened = new UrlShortened($code, $url, 0, 0);
        $this->urlShortenedRepository->saveUrlShortened($urlShortened);

        return $urlShortened;
    }

    /**
     * @param string $url
     * @return string
     */
    public function formatUrl(string $url): string
    {
        $urlSplit = explode(self::HTTP, $url);
        if (!empty($urlSplit[0])) {
            $url = self::HTTP . $url;
        }
        return $url;
    }
}