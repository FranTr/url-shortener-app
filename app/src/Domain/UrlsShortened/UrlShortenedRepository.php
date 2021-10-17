<?php

namespace App\Domain\UrlsShortened;

interface UrlShortenedRepository
{
    public function saveUrlShortened(UrlShortened $urlShortened) :void;

    public function findUrlShortenedByCode(String $code) : ?UrlShortened;

    public function findUrlShortenedByUrl(string $url): ?UrlShortened;
}