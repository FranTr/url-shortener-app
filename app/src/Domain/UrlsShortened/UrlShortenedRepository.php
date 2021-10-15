<?php

namespace App\Domain\UrlsShortened;

interface UrlShortenedRepository
{
    public function saveUrlShortened(UrlShortened $urlShortened) :void;
}